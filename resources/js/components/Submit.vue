<template>
    <div class="submit-wrap">
        <select-option
            v-if="needConfirm === 1"
            @option-selected="handleOptionSelected"
        ></select-option>
        <Editor
            v-if="needFeedback === 1"
            v-model="feedback"
            @feedback="handleFeedBack"
        ></Editor>
        <button
            type="submit"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalSubmit"
        >
            Submit
        </button>
        <div
            class="modal fade"
            id="modalSubmit"
            tabindex="-1"
            aria-labelledby="modalSubmitLabel"
            aria-hidden="true"
            ref="modalSubmit"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="../assets/images/SVG/modal.svg" />
                        <div>are you sure ?</div>
                        <div>you have selected {{ option }}</div>
                        <div>here is your feedback: {{ feedback }}</div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="onSubmit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SelectOption from "./SelectOption.vue";
import Editor from "./Editor.vue";
import axios from "axios";
import { EventBus } from "../app.js";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Submit",
    props: {
        needConfirm: Number,
        needFeedback: Number,
        userEmail: String,
        mailId: Number,
    },
    data() {
        return {
            feedback: "",
            option: "",
            isSubmitted: false,
        };
    },
    components: {
        SelectOption,
        Editor,
    },
    methods: {
        async onSubmit() {
            try {
                let isAuth = this.$route.query.param;
                let apiRequest = `${apiPath}/receiver-mail/store`;
                await axios.post(apiRequest, {
                    user_mail: this.userEmail,
                    mail_id: this.mailId,
                    confirm: this.option,
                    feedback: this.feedback,
                });
                this.isSubmitted = true;
                this.onFetchData()
                // console.log(this.feedback, this.option);
                alert("Successfully submitted");
            } catch (err) {
                console.log(err);
            }
        },
        handleOptionSelected(option) {
            this.option = option;
        },
        handleFeedBack(feedback) {
            this.feedback = feedback;
        },
        onFetchData() {
            this.$emit("onFetchData", this.isSubmitted);
        }
    },
};
</script>

<style></style>
