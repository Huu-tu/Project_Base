<template>
    <div class="main-container">
        <div class="spinner-wrap" v-if="loadSpinner">
            <div class="overlay"></div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="main-wrap">
            <div class="navigation-wrap">
                <div class="sample-text">
                    <div class="blind-button">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            fill="rgba(0, 102, 178, 0.9)"
                            width="1rem"
                            height="1rem"
                        >
                            <path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"
                            />
                        </svg>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            fill="rgba(242, 111, 33, 0.9)"
                            width="1rem"
                            height="1rem"
                        >
                            <path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"
                            />
                        </svg>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            fill="rgba(13, 176, 75, 0.9)"
                            width="1rem"
                            height="1rem"
                        >
                            <path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"
                            />
                        </svg>
                    </div>
                    {{ title }}
                </div>
                <div class="navigation-wrapper">
                    <button v-if="!authFlag" class="btn btn-outline-secondary">
                        <img src="../assets/images/SVG/back.svg" />
                    </button>
                    <button v-if="!authFlag" class="btn btn-outline-secondary">
                        <img src="../assets/images/SVG/delete.svg" />
                    </button>
                </div>
            </div>
            <div class="body-wrap">
                <div class="body-section">
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
                    </div>
                </div>
                <div
                    class="body-section"
                    v-if="(needConfirm !== 0 || needFeedback !== 0) && isSubmitted === false"
                >
                    <img :src="userAvatar" />
                    <Submit
                        :needConfirm="needConfirm"
                        :needFeedback="needFeedback"
                        :userEmail="userEmail"
                        :mailId="id"
                        @fetchSubmit="handleFetchData"
                    ></Submit>
                </div>
                <div class="body-section" v-if="isSubmitted === true">
                    <img :src="userAvatar" />
                    <Result
                        :userEmail="userEmail"
                        :mailId="id"
                    ></Result>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Submit from "./Submit.vue";
import Result from './Result.vue'
import axios from "axios";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Show",
    components: {
        Submit,
        Result,
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
        userAvatar: String,
    },
    data() {
        return {
            feedback: "",
            type: "",
            isSubmitted: null,
            loadSpinner: "",
        };
    },
    mounted() {
        this.handleFetchData()
    },
    methods: {
        async handleFetchData() {
            try {
                this.loadSpinner = true;

                let apiRequest = `${apiPath}/get-receiver/${this.userEmail}/${this.id}`;
                let resRequest  = (await axios.get(apiRequest)).data;

                if(resRequest.id != null) {
                    this.isSubmitted = true;
                    
                } else {
                    this.isSubmitted = false;
                }
                console.log(this.isSubmitted)
                this.loadSpinner = false;
            } catch(e) {
                console.log(e)
                this.loadSpinner = false;
            }
        }
    },
};
</script>

<style></style>
