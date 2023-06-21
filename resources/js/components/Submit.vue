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
        <button class="btn btn-primary" type="submit" @click="onSubmit">Submit</button>
    </div>
</template>

<script>
import SelectOption from "./SelectOption.vue";
import Editor from "./Editor.vue";
import axios from "axios";
import { EventBus }  from '../app.js'

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
                console.log(this.feedback, this.option)
                alert("Successfully submitted")
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
        // onFetchData() {
        //     EventBus.$emit("onFetchData");
        // }
    },
};
</script>

<style></style>
