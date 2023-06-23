<template>
    <div class="result-wrap">
        <div
            class="option-wrap"
            v-if="option !== null"
            :class="[optionFlag ? 'confirm' : 'reject']"
        >
            {{ option }}
        </div>
        <div class="note-wrap" v-if="feedback !== null">
            <img src="../assets/images/SVG/quote.svg" />
            <span>{{ feedback }}</span>
        </div>
        <div class="time-post">{{ time }}</div>
    </div>
</template>

<script>
import axios from "axios";
import { convertDate } from "../convert.js";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Result",
    props: {
        userEmail: String,
        mailId: Number,
    },
    data() {
        return {
            feedback: "",
            option: null,
            optionFlag: null,
            time: "",
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                let apiRequest = `${apiPath}/get-receiver/${this.userEmail}/${this.mailId}`;
                console.log("api res ", apiRequest);
                let resRequest = (await axios.get(apiRequest)).data;
                this.feedback = resRequest.feedback;
                if (resRequest.confirm === 1) {
                    this.option = "Confirm";
                    this.optionFlag = true;
                } else if (resRequest.confirm === 0) {
                    this.option = "Reject";
                    this.optionFlag = false;
                } else {
                    this.option = null;
                }
                this.time = convertDate(resRequest.created_at);
            } catch (e) {
                console.log(e, "loi o res");
            }
        },
    },
};
</script>

<style></style>
