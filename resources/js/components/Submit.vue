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
            @click="check"
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
                        <div class="title" v-if="option == null && (feedback == '' || feedback == null)">Fill out something first!</div>
                        <div class="title" v-else>Are you sure ?</div>
                        <div v-if="option != null" class="sub-title">You have selected <span>{{ optionText }}</span></div>
                        <div v-if="feedback != '' && feedback != null" class="sub-title">Here is your feedback:<br><span>{{ feedback }}</span></div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="onSubmit" v-if="this.option || this.feedback" >Save changes</button>
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
            feedback: null,
            option: null,
            optionText: '',
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
                console.log(this.userEmail, this.mailId, this.option, this.feedback)
                let apiRequest = `${apiPath}/receiver-mail/store`;
                await axios.post(apiRequest, {
                    user_mail: this.userEmail,
                    mail_id: this.mailId,
                    confirm: this.option,
                    feedback: this.feedback,
                });
                alert("Successfully submitted");
                this.onfetchSubmit()
            } catch (err) {
                console.log(err);
            }
        },
        handleOptionSelected(option) {
            this.option = option
            if(option == 1) {
                this.optionText = 'CONFIRM'
            } else {
                this.optionText = 'REJECT'
            }
        },
        handleFeedBack(feedback) {
            this.feedback = feedback;
        },
        onfetchSubmit() {
            this.$emit("fetchSubmit")
        },
        check() {
            console.log('option', this.option)
            console.log('text', this.feedback)
        }
    },
};
</script>

<style></style>
