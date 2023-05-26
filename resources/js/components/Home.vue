<template>
    <div>
        <Header :userName="index_userName"></Header>
        <template v-if="type === '2'">
            <Notify
                :title="index_title"
                :userName="index_userName"
                :email="index_email"
                :time="index_time"
                :content="index_content"
                :status="index_status"
                :id_request="index_id"
            ></Notify>
        </template>
        <template v-else-if="type === '1'">
            <Show
                :title="index_title"
                :userName="index_userName"
                :email="index_email"
                :time="index_time"
                :content="index_content"
                :status="index_status"
                :id_request="index_id"
                @onFetchData="fetchData"
            ></Show>
        </template>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import Notify from "../components/Notify.vue";
import Show from "../components/Show.vue";
import { mapState, mapGetters } from "vuex";
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
        };
    },
    methods: {
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
        async fetchData() {
            try {
                let post_id = this.$route.params.id;
                const response = await axios.get(
                    `http://127.0.0.1:8000/permission/${post_id}`
                );
                console.log(response.data.data[0]);
                var apiPath = response.data.data[0];
                this.index_title = apiPath.title;
                this.index_userName = apiPath.sender;
                this.index_email = apiPath.email;
                this.index_time = this.convertDate(apiPath.created_at);
                this.index_content = apiPath.content;
                this.index_id = apiPath.id;
                this.index_status = apiPath.status;
                this.type = apiPath.type;
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

<style></style>
