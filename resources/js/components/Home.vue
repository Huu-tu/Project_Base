<template>
    <div>
        <Header
            :userName="userName"
            :userAvatar="userAvatar"
            :userEmail="userEmail"
            :authFlag="authFlag"
        ></Header>
        <Spinner :loadSpinner="loadSpinner"></Spinner>
        <template v-if="!loadSpinner">
            <Show
                :id="requestId"
                :title="requestTitle"
                :email="requestEmail"
                :sender="requestSender"
                :content="requestContent"
                :needConfirm="requestNeedConfirm"
                :needFeedback="requestNeedFeedback"
                :createdAt="requestCreatedTime"
                :avatar="requestAvatar"
                :authFlag="authFlag"
                :userEmail="userEmail"
                :userAvatar="userAvatar"
                @onFetchData="fetchData"
            ></Show>
        </template>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import Show from "./Show.vue";
import Spinner from "./Spinner.vue";
import axios from "axios";
import { convertDate } from "../convert.js";
import { EventBus } from "../app.js";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "home",
    components: {
        Header,
        Show,
        Spinner,
    },
    created() {
        this.fetchData();
    },
    data() {
        return {
            requestId: 0,
            requestTitle: "",
            requestEmail: "",
            requestSender: "",
            requestContent: "",
            requestNeedConfirm: 0,
            requestNeedFeedback: 0,
            requestCreatedTime: "",
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

                let mailId = this.$route.params.id;
                let isAuth = this.$route.query.param;
                let flagCheck = this.$route.fullPath;

                flagCheck.includes("isAuth")
                    ? (this.authFlag = true)
                    : (this.authFlag = false);

                let apiRequest = `${apiPath}/mail/${mailId}`;
                let resRequest = (await axios.get(apiRequest)).data.data[0];
                console.log(resRequest);

                this.requestId = resRequest.id;
                this.requestTitle = resRequest.title;
                this.requestEmail = resRequest.email;
                this.requestSender = resRequest.sender;
                this.requestContent = resRequest.content;
                this.requestNeedConfirm = resRequest.need_confirm;
                this.requestNeedFeedback = resRequest.need_feedback;
                this.requestCreatedTime = convertDate(resRequest.created_at);
                this.requestAvatar = `https://ui-avatars.com/api/?background=random&name=${encodeURIComponent(
                    resRequest.sender
                )}&rounded=true&?bold=true`;

                let apiUser = `${apiPath}/info-user?isAuth=${isAuth}`;
                let resUser = (await axios.get(apiUser)).data;
                console.log(resUser);
                this.userAvatar = resUser.avatar;
                this.userName = resUser.name;
                this.userEmail = resUser.email;

                this.loadSpinner = false;
            } catch (error) {
                console.log(error);
                this.loadSpinner = false;
            }
        },
    },
};
</script>

<style></style>
