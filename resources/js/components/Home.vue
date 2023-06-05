<template>
    <div>
        <Header
            :userName="userName"
            :userAvatar="userAvatar"
            :userEmail="userEmail"
            :authFlag="authFlag"
        ></Header>
        <div class="spinner-wrap" v-if="loadSpinner">
            <div class="overlay"></div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <!-- <div class="spinner-text">ĐANG XỬ LÝ YÊU CẦU</div> -->
        </div>
        <template v-if="requestType === '2' && !loadSpinner">
            <Notify
                :id="requestId"
                :title="requestTitle"
                :content="requestContent"
                :email="requestEmail"
                :sender="requestSender"
                :status="requestStatus"
                :createdAt="requestCreatedTime"
                :party="requestParty"
                :avatar="requestAvatar"
                :authFlag="authFlag"
            ></Notify>
        </template>
        <template v-else-if="requestType === '1' && !loadSpinner">
            <Show
                :id="requestId"
                :title="requestTitle"
                :content="requestContent"
                :email="requestEmail"
                :sender="requestSender"
                :status="requestStatus"
                :createdAt="requestCreatedTime"
                :party="requestParty"
                :avatar="requestAvatar"
                :authFlag="authFlag"
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

const apiPath = process.env.MIX_API_PATH;

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
            requestId: "",
            requestTitle: "",
            requestContent: "",
            requestEmail: "",
            requestSender: "",
            requestStatus: "",
            requestCreatedTime: "",
            requestType: "",
            requestParty: "",
            requestAvatar: "",

            userName: "",
            userAvatar: "",
            userEmail: "",

            loadSpinner: "",
            authFlag: false,
        };
    },
    methods: {
        async fetchData() {
            try {
                this.loadSpinner = true;

                let permissionId = this.$route.params.id;
                let isAuth = this.$route.query.param;
                let flagCheck = this.$route.fullPath;

                flagCheck.includes("isAuth")
                    ? (this.authFlag = true)
                    : (this.authFlag = false);

                let apiRequest = `${apiPath}/permission/${permissionId}?isAuth=${isAuth}`;
                let resRequest = (await axios.get(apiRequest)).data.data[0];

                this.requestAvatar = `https://ui-avatars.com/api/?background=random&name=${encodeURIComponent(
                    resRequest.sender
                )}&rounded=true&?bold=true`;
                this.requestTitle = resRequest.title;
                this.requestSender = resRequest.sender;
                this.requestEmail = resRequest.email;
                this.requestCreatedTime = this.convertDate(
                    resRequest.created_at
                );
                this.requestContent = resRequest.content;
                this.requestId = resRequest.id;
                this.requestStatus = resRequest.status;
                this.requestParty = resRequest.party;
                this.requestType = resRequest.type;

                let apiUser = `${apiPath}/info-user?isAuth=${isAuth}`;
                let resUser = (await axios.get(apiUser)).data;

                this.userAvatar = resUser.avatar;
                this.userName = resUser.name;
                this.userEmail = resUser.email;

                this.loadSpinner = false;
            } catch (error) {
                console.log(error);
                this.loadSpinner = false;
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
