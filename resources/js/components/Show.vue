<template>
    <div class="main-container">
        <div class="main-wrap">
            <div class="navigation-wrap">
                <div class="sample-text">Subject name: Lorem ipsum</div>
                <div class="sample-nav">
                    <div class="btn-back">
                        <a @click="onBackClick" v-if="!authFlag"> Quay lại </a>
                    </div>
                    <div class="btn-delete">
                        <a v-if="!authFlag"> Xóa </a>
                    </div>
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
                            <!-- <div class="info-party">
                                <span class="badge">{{ party }}</span>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="mail-wrap">
                    <span v-html="content"></span>
                </div>
            </div>
            <div class="submit-wrap">
                <div class="process-wrap">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalAccepted"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="1.1rem"
                            width="1.1rem"
                            fill="currentColor"
                            viewBox="0 0 448 512"
                        >
                            <path
                                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"
                            />
                        </svg>
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
                                    <img src="../assets/images/modal.svg" />
                                    <p class="title">
                                        You have selected 'CONFIRM'
                                    </p>
                                    <p class="sub-title">
                                        Add some notes (Optional)
                                    </p>
                                    <textarea class="form-control"></textarea>
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
                                            @click="onConfirm"
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
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="1.1rem"
                            width="1.1rem"
                            fill="currentColor"
                            viewBox="0 0 384 512"
                        >
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                            />
                        </svg>
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
                                    <img src="../assets/images/modal.svg" />
                                    <p class="title">
                                        You have selected 'REJECT'
                                    </p>
                                    <p class="sub-title">
                                        Add some notes (Optional)
                                    </p>
                                    <textarea class="form-control"></textarea>
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
                                            @click="onReject"
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
import bootstrap from "../../../node_modules/bootstrap/dist/js/bootstrap.bundle.js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Editor from "./Editor.vue";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Show",
    components: {
        Editor: Editor,
    },
    props: {
        id: Number,
        title: String,
        content: String,
        email: String,
        sender: String,
        status: Number,
        createdAt: String,
        avatar: String,
        authFlag: Boolean,
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                language: "vi",
            },
        };
    },
    methods: {
        async onConfirm() {
            try {
                let isAuth = this.$route.query.param;
                let apiRequest = `${apiPath}/permission/confirm/${this.id}?isAuth=${isAuth}`;
                let resRequest = await axios.get(apiRequest);
                console.log("res", resRequest);

                let vm = this;
                let modal = this.$refs.modalAccepted;
                modal.addEventListener("hide.bs.modal", function () {
                    vm.onFetchData();
                });
                let bsModal = bootstrap.Modal.getInstance(modal);
                bsModal.hide();
            } catch (err) {
                console.log(err);
            }
        },
        async onReject() {
            try {
                let isAuth = this.$route.query.param;
                let apiRequest = `${apiPath}/permission/reject/${this.id}?isAuth=${isAuth}`;
                let resRequest = await axios.get(apiRequest);
                console.log("res", resRequest);

                let vm = this;
                let modal = this.$refs.modalCanceled;
                modal.addEventListener("hide.bs.modal", function () {
                    vm.onFetchData();
                });
                let bsModal = bootstrap.Modal.getInstance(modal);
                bsModal.hide();
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
    },
};
</script>

<style></style>
