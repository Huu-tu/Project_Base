<template>
    <div class="main-container">
        <div class="main-wrap">
            <div class="infomation-wrap">
                <div class="info-title">
                    <button
                        type="button"
                        class="btn btn-back"
                        @click="onBackClick"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"
                        >
                            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
                            />
                        </svg>
                    </button>
                    {{ title }}
                </div>
                <div class="infomation-container">
                    <div class="info-wrap">
                        <img :src="avatar" />
                        <div class="info-name-mail-party">
                            <div class="info-name-mail">
                                <div class="info-name">{{ userName }}</div>
                                <div class="info-mail">&lt;{{ email }}&gt;</div>
                            </div>
                            <div class="info-party">"12312312"</div>
                        </div>
                    </div>
                    <div class="info-time">{{ time }}</div>
                </div>
            </div>
            <div class="mail-wrap">
                {{ content }}
            </div>
            <div class="nav-wrap" v-if="status === 'pending'">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAccepted"
                    @click="onConfirm"
                >
                    Xác nhận
                </button>
                <div
                    class="modal fade"
                    id="modalAccepted"
                    tabindex="-1"
                    aria-labelledby="modalAcceptedLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <svg
                                    width="40"
                                    height="40"
                                    viewBox="0 0 40 40"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M17.05 29.1L31.2 14.95L28.9 12.7L17.05 24.55L11.05 18.55L8.8 20.8L17.05 29.1ZM20 40C17.2667 40 14.6833 39.475 12.25 38.425C9.81667 37.375 7.69167 35.9417 5.875 34.125C4.05833 32.3083 2.625 30.1833 1.575 27.75C0.525 25.3167 0 22.7333 0 20C0 17.2333 0.525 14.6333 1.575 12.2C2.625 9.76667 4.05833 7.65 5.875 5.85C7.69167 4.05 9.81667 2.625 12.25 1.575C14.6833 0.525 17.2667 0 20 0C22.7667 0 25.3667 0.525 27.8 1.575C30.2333 2.625 32.35 4.05 34.15 5.85C35.95 7.65 37.375 9.76667 38.425 12.2C39.475 14.6333 40 17.2333 40 20C40 22.7333 39.475 25.3167 38.425 27.75C37.375 30.1833 35.95 32.3083 34.15 34.125C32.35 35.9417 30.2333 37.375 27.8 38.425C25.3667 39.475 22.7667 40 20 40ZM20 37C24.7333 37 28.75 35.3417 32.05 32.025C35.35 28.7083 37 24.7 37 20C37 15.2667 35.35 11.25 32.05 7.95C28.75 4.65 24.7333 3 20 3C15.3 3 11.2917 4.65 7.975 7.95C4.65833 11.25 3 15.2667 3 20C3 24.7 4.65833 28.7083 7.975 32.025C11.2917 35.3417 15.3 37 20 37Z"
                                        fill="#4EBF19"
                                    />
                                </svg>
                                <div class="model-content">
                                    Đã duyệt đơn thành công!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCanceled"
                    @click="onReject"
                >
                    Từ chối
                </button>
                <div
                    class="modal fade"
                    id="modalCanceled"
                    tabindex="-1"
                    aria-labelledby="modalCanceledLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="48"
                                    viewBox="0 -960 960 960"
                                    width="48"
                                >
                                    <path
                                        d="m330-288 150-150 150 150 42-42-150-150 150-150-42-42-150 150-150-150-42 42 150 150-150 150 42 42ZM480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-156t86-127Q252-817 325-848.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82-31.5 155T763-197.5q-54 54.5-127 86T480-80Zm0-60q142 0 241-99.5T820-480q0-142-99-241t-241-99q-141 0-240.5 99T140-480q0 141 99.5 240.5T480-140Zm0-340Z"
                                        fill="#dc3545"
                                    />
                                </svg>
                                <div class="model-content">
                                    Đã từ chối đơn thành công!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="nav-wrap-after"
                v-else-if="status === 'Xac nhan'"
                id="accepted"
            >
                <svg
                    width="40"
                    height="40"
                    viewBox="0 0 40 40"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M17.05 29.1L31.2 14.95L28.9 12.7L17.05 24.55L11.05 18.55L8.8 20.8L17.05 29.1ZM20 40C17.2667 40 14.6833 39.475 12.25 38.425C9.81667 37.375 7.69167 35.9417 5.875 34.125C4.05833 32.3083 2.625 30.1833 1.575 27.75C0.525 25.3167 0 22.7333 0 20C0 17.2333 0.525 14.6333 1.575 12.2C2.625 9.76667 4.05833 7.65 5.875 5.85C7.69167 4.05 9.81667 2.625 12.25 1.575C14.6833 0.525 17.2667 0 20 0C22.7667 0 25.3667 0.525 27.8 1.575C30.2333 2.625 32.35 4.05 34.15 5.85C35.95 7.65 37.375 9.76667 38.425 12.2C39.475 14.6333 40 17.2333 40 20C40 22.7333 39.475 25.3167 38.425 27.75C37.375 30.1833 35.95 32.3083 34.15 34.125C32.35 35.9417 30.2333 37.375 27.8 38.425C25.3667 39.475 22.7667 40 20 40ZM20 37C24.7333 37 28.75 35.3417 32.05 32.025C35.35 28.7083 37 24.7 37 20C37 15.2667 35.35 11.25 32.05 7.95C28.75 4.65 24.7333 3 20 3C15.3 3 11.2917 4.65 7.975 7.95C4.65833 11.25 3 15.2667 3 20C3 24.7 4.65833 28.7083 7.975 32.025C11.2917 35.3417 15.3 37 20 37Z"
                        fill="#4EBF19"
                    />
                </svg>
                <div class="nav-wrap-after-text accepted">
                    Đơn đã được chấp nhận!
                </div>
            </div>
            <div
                class="nav-wrap-after"
                v-else-if="status === 'Tu choi'"
                id="rejected"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="48"
                    viewBox="0 -960 960 960"
                    width="48"
                    fill="none"
                >
                    <path
                        d="m330-288 150-150 150 150 42-42-150-150 150-150-42-42-150 150-150-150-42 42 150 150-150 150 42 42ZM480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-156t86-127Q252-817 325-848.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82-31.5 155T763-197.5q-54 54.5-127 86T480-80Zm0-60q142 0 241-99.5T820-480q0-142-99-241t-241-99q-141 0-240.5 99T140-480q0 141 99.5 240.5T480-140Zm0-340Z"
                        fill="#dc3545"
                    />
                </svg>
                <div
                    style="display: block"
                    class="nav-wrap-after-text rejected"
                >
                    Đơn đã bị từ chối!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Show",
    props: {
        title: String,
        userName: String,
        email: String,
        time: String,
        content: String,
        status: String,
        avatar: String,
        // party: String,
        id_request: null,
    },
    mounted() {
        console.log(this.status);
    },
    methods: {
        async onConfirm() {
            try {
                let url = `http://127.0.0.1:8000/permission/confirm/${this.id_request}`;
                let res = await axios.get(url);
                console.log("res", res);
                let vm = this;
                let myModal = document.getElementById("modalAccepted");
                myModal.addEventListener("hide.bs.modal", function () {
                    vm.onFetchData();
                });
            } catch (err) {
                console.log(err);
            }
        },
        async onReject() {
            try {
                let url = `http://127.0.0.1:8000/permission/reject/${this.id_request}`;
                let res = await axios.get(url);
                console.log("res", res);
                let vm = this;
                let myModal = document.getElementById("modalCanceled");
                myModal.addEventListener("hide.bs.modal", function () {
                    vm.onFetchData();
                });
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
