<template>
    <div class="main-container">
        <div class="main-wrap">
            <div class="navigation-wrap">
                <div class="sample-text">Subject name</div>
                <div class="navigation-wrapper">
                    <button
                        v-if="!authFlag"
                        class="btn btn-outline-secondary"
                        @click="onBackClick"
                    >
                        <img src="../assets/images/SVG/back.svg" />
                    </button>

                    <button
                        v-if="!authFlag"
                        class="btn btn-outline-secondary"
                    >
                        <img src="../assets/images/SVG/delete.svg" />
                    </button>
                </div>
            </div>
            <div class="infomation-wrap">
                <div class="info-title">
                    {{ title }}
                </div>
                <div class="infomation-container">
                    <div class="info-wrap">
                        <img :src="avatar" />
                        <div class="info-wrap-container">
                            <div class="info-content">
                                <div class="info-content-left">
                                    <div class="info-name">{{ sender }}</div>
                                    <div class="info-mail">
                                        &lt;{{ email }}&gt;
                                    </div>
                                </div>
                                <div class="info-time info-content-right">
                                    {{ createdAt }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mail-wrap">
                    <span v-html="content"></span>
                </div>
            </div>
            <div class="submit-wrap">
                <div class="process-wrap" v-if="needConfirm == 1">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAccepted"
                        @click="submitType(1)"
                    >
                        <img src="../assets/images/SVG/check.svg" />
                        Xác nhận
                    </button>
                    <div
                        class="modal fade"
                        id="modalAccepted"
                        tabindex="-1"
                        aria-labelledby="modalAcceptedLabel"
                        aria-hidden="true"
                        ref="modalAccepted"
                    >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="../assets/images/SVG/modal.svg" />
                                    <p class="title">
                                        You have selected 'CONFIRM'
                                    </p>
                                    <p class="sub-title" v-if="needFeedback == 1">
                                        Add some notes (Optional)
                                    </p>
                                    <textarea class="form-control" v-if="needFeedback == 1" v-model="feedback"></textarea>
                                    <div class="button-wrapper">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Cancel
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            @click="onSubmit"
                                            data-bs-dismiss="modal"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalCanceled"
                        @click="submitType(0)"
                    >
                        <img src="../assets/images/SVG/xmark.svg" />
                        Từ chối
                    </button>
                    <div
                        class="modal fade"
                        id="modalCanceled"
                        tabindex="-1"
                        aria-labelledby="modalCanceledLabel"
                        aria-hidden="true"
                        ref="modalCanceled"
                    >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="../assets/images/SVG/modal.svg" />
                                    <p class="title">
                                        You have selected 'REJECT'
                                    </p>
                                    <p class="sub-title" v-if="needFeedback == 1">
                                        Add some notes (Optional)
                                    </p>
                                    <textarea class="form-control" v-if="needFeedback == 1" v-model="feedback"></textarea>
                                    <div class="button-wrapper">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Cancel
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            @click="onSubmit"
                                            data-bs-dismiss="modal"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="process-wrap" v-if="needFeedback == 1 && needConfirm != 1">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalFeedBack"
                    >
                        <img src="../assets/images/SVG/message.svg" />
                        Send notes
                    </button>
                    <div
                        class="modal fade"
                        id="modalFeedBack"
                        tabindex="-1"
                        aria-labelledby="modalFeedBackLabel"
                        aria-hidden="true"
                        ref="modalFeedBack"
                    >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="../assets/images/SVG/modal.svg" />
                                    <p class="sub-title">Send FeedBack</p>
                                    <textarea class="form-control" v-model="feedback"></textarea>
                                    <div class="button-wrapper">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Cancel
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            @click="onSubmit"
                                            data-bs-dismiss="modal"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
// import bootstrap from "../../../node_modules/bootstrap/dist/js/bootstrap.bundle.js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Editor from "./Editor.vue";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Show",
    components: {
        Editor: Editor,
    },
    props: {
        id: null,
        title: String,
        email: String,
        sender: String,
        content: String,
        needConfirm: null,
        needFeedback: null, /*Sai kiểu dữ liệu*/
        createdAt: String,
        avatar: String,
        authFlag: Boolean,
        userEmail: String,
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                language: "vi",
            },
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
                    'user_mail': this.userEmail,
                    'mail_id': this.id,
                    'confirm': this.type,
                    'feedback': this.feedback
                });
                // let vm = this;
                // let modal = this.$refs.modalAccepted;
                // modal.addEventListener("hide.bs.modal", function () {
                //     vm.onFetchData();
                // });
                // let bsModal = bootstrap.Modal.getInstance(modal);
                // bsModal.hide();
            } catch (err) {
                console.log(err);
            }
        },
        onFetchData() {
            this.$emit("onFetchData");
        },
        onBackClick() {
            this.$router.push("/list");
        },
        submitType(type) {
            this.type = type;
        }
    },
};
</script>

<style></style>
