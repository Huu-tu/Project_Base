<template>
    <div class="main-container">
        <div class="main-wrap">
            <div class="infomation-wrap">
                <button
                    type="button"
                    class="btn btn-back"
                    @click="onBackClick"
                    v-if="!authFlag"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        height="1em"
                        viewBox="0 0 512 512"
                        fill="#394867"
                    >
                        <path
                            d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"
                        />
                    </svg>
                    <span>Quay lại</span>
                </button>
                <div class="info-title">
                    {{ title }}
                </div>
                <div class="infomation-container">
                    <div class="info-wrap">
                        <img :src="avatar" />
                        <div class="info-name-mail-party">
                            <div class="info-name-mail">
                                <div class="info-name">{{ sender }}</div>
                                <div class="info-mail">&lt;{{ email }}&gt;</div>
                            </div>
                            <div class="info-party">
                                <span class="badge">{{ party }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="info-time">{{ createdAt }}</div>
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
                    ref="modalAccepted"
                >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="40"
                                    width="40"
                                    viewBox="0 0 512 512"
                                    fill="#4EBF19"
                                >
                                    <path
                                        d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"
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
                    ref="modalCanceled"
                >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="40"
                                    width="40"
                                    viewBox="0 0 512 512"
                                    fill="#DC3545"
                                >
                                    <path
                                        d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"
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
                    xmlns="http://www.w3.org/2000/svg"
                    height="40"
                    width="40"
                    viewBox="0 0 512 512"
                    fill="#4EBF19"
                >
                    <path
                        d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"
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
                    height="40"
                    width="40"
                    viewBox="0 0 512 512"
                    fill="#DC3545"
                >
                    <path
                        d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"
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

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Show",
    props: {
        id: Number,
        title: String,
        content: String,
        email: String,
        sender: String,
        status: String,
        createdAt: String,
        party: String,
        avatar: String,
        authFlag: Boolean,
    },
    methods: {
        async onConfirm() {
            try {
                let isAuth = this.$route.query.param;
                let apiRequest = `${apiPath}/permission/confirm/${this.id}?param=${isAuth}`;
                let resRequest = await axios.get(apiRequest);
                console.log("res", resRequest);

                let vm = this;
                let modal = this.$refs.modalAccepted;
                modal.addEventListener("hide.bs.modal", function () {
                    vm.onFetchData();
                });
            } catch (err) {
                console.log(err);
            }
        },
        async onReject() {
            try {
                let isAuth = this.$route.query.param;
                let apiRequest = `${apiPath}/permission/reject/${this.id}?param=${isAuth}`;
                let resRequest = await axios.get(apiRequest);
                console.log("res", resRequest);

                let vm = this;
                let modal = this.$refs.modalCanceled;
                modal.addEventListener("hide.bs.modal", function () {
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
