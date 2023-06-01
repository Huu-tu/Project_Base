<template>
    <div>
        <Header
            :userName="user_name"
            :userAvatar="user_avatar"
            :userEmail="user_email"
        ></Header>
        <div class="spinner-wrap" v-if="loading">
                <div class="overlay"></div>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <!-- <div class="spinner-text">ĐANG XỬ LÝ YÊU CẦU</div> -->
            </div>
        <template v-if="type === '2' && !loading">
            <Notify
                :title="index_title"
                :userName="index_userName"
                :email="index_email"
                :time="index_time"
                :content="index_content"
                :status="index_status"
                :avatar="index_avatar"
                :id_request="index_id"
            ></Notify>
        </template>
        <template v-else-if="type === '1' && !loading">
            <Show
                :title="index_title"
                :userName="index_userName"
                :email="index_email"
                :time="index_time"
                :content="index_content"
                :status="index_status"
                :id_request="index_id"
                :avatar="index_avatar"
                @onFetchData="fetchData"
            ></Show>
        </template>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import Notify from "../components/Notify.vue";
import Show from "../components/Show.vue";
import axios from "axios";

export default {
    name: "home",
    components: {
        Header: Header,
        Notify: Notify,
        Show: Show,
    },
    mounted() {
        this.fetchData();
    },
    data() {
        return {
            type: "",
            index_title: "",
            index_userName: "",
            index_email: "",
            index_time: "",
            index_content: "",
            index_status: "",
            index_id: "",
            index_avatar: "",

            user_name: "",
            user_avatar: "",
            user_email: "",

            loading: "",
        };
    },
    methods: {
        async fetchData() {
            try {
                this.loading = true;

                let post_id = this.$route.params.id;
                let url = `http://127.0.0.1:8000/permission/${post_id}`;
                let response = await axios.get(url);
                var apiPath = response.data.data[0];
                this.index_avatar = `https://ui-avatars.com/api/?background=random&name=${encodeURIComponent(
                    apiPath.sender
                )}&rounded=true&?bold=true`;
                this.index_title = apiPath.title;
                this.index_userName = apiPath.sender;
                this.index_email = apiPath.email;
                this.index_time = this.convertDate(apiPath.created_at);
                this.index_content = apiPath.content;
                this.index_id = apiPath.id;
                this.index_status = apiPath.status;
                this.type = apiPath.type;

                let urlUser = `http://127.0.0.1:8000/info-user`;
                let responseUser = await axios.get(urlUser);
                var apiUser = responseUser.data;
                this.user_avatar = apiUser.avatar;
                this.user_name = apiUser.name;
                this.user_email = apiUser.email;

                this.loading = false;
            } catch (error) {
                console.log(error);
                this.loading = false;
            }
        },
        convertDate(inputDate) {
            let date = new Date(inputDate);
            // Chuyển đổi sang định dạng AM/PM
            let hours = date.getHours() % 12 || 12;
            let minutes = date.getMinutes();
            let period = date.getHours() >= 12 ? "pm" : "am";
            // Chuyển đổi sang định dạng ngày/tháng/năm
            let day = date.getDate();
            let month = date.getMonth() + 1; // Tháng trong JavaScript đếm từ 0, nên cần +1
            let year = date.getFullYear();
            // Xuất giờ cuối cùng
            let outputDate = `${hours}:${minutes
                .toString()
                .padStart(2, "0")}${period} ${day
                .toString()
                .padStart(2, "0")}/${month
                .toString()
                .padStart(2, "0")}/${year}`;
            return outputDate;
        },
    },
};
</script>

<style></style>
