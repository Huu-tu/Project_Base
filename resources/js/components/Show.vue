<template>
    <div class="main-container">
        <div class="main-wrap">
            <div class="navigation-wrap">
                <div class="sample-text">Subject name</div>
                <div class="navigation-wrapper">
                    <button v-if="!authFlag" class="btn btn-outline-secondary">
                        <img src="../assets/images/SVG/back.svg" />
                    </button>

                    <button v-if="!authFlag" class="btn btn-outline-secondary">
                        <img src="../assets/images/SVG/delete.svg" />
                    </button>
                </div>
            </div>
            <div class="title-wrap">
                {{ title }}
            </div>
            <div class="body-wrap">
                <img :src="avatar" />
                <div class="body-container">
                    <div class="info-wrap">
                        <div class="info-wrap-left">
                            <div class="info-name">{{ sender }}</div>
                            <div class="info-mail">&lt;{{ email }}&gt;</div>
                        </div>
                        <div class="info-time info-content-right">
                            {{ createdAt }}
                        </div>
                    </div>
                    <div class="content-wrap">
                        <span v-html="content"></span>
                    </div>
                    <Submit
                        :needConfirm="needConfirm"
                        :needFeedback="needFeedback"
                    ></Submit>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Submit from "./Submit.vue";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Show",
    components: {
        Submit,
    },
    props: {
        id: Number,
        title: String,
        email: String,
        sender: String,
        content: String,
        needConfirm: Number,
        needFeedback: Number,
        createdAt: String,
        avatar: String,
        authFlag: Boolean,
        userEmail: String,
    },
    data() {
        return {
            feedback: "",
            type: "",
        };
    },
    methods: {
        async onSubmit() {
            try {
                let isAuth = this.$route.query.param;
                let apiRequest = `${apiPath}/receiver-mail/store`;
                await axios.post(apiRequest, {
                    user_mail: this.userEmail,
                    mail_id: this.id,
                    confirm: this.type,
                    feedback: this.feedback,
                });
            } catch (err) {
                console.log(err);
            }
        },
        onFetchData() {
            this.$emit("onFetchData");
        },
        submitType(type) {
            this.type = type;
        },
    },
};
</script>

<style></style>
