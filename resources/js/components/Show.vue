<template>
    <div class="main-container">
        <div class="main-wrap">
            <div class="navigation-wrap">
                <a class="btn-back" @click="onBackClick" v-if="!authFlag">
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
                </a>
                <a class="btn-back" v-if="!authFlag">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        height="1em"
                        viewBox="0 0 448 512"
                        fill="#394867"
                    >
                        <path
                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"
                        />
                    </svg>
                    <span>Xóa</span>
                </a>
            </div>
            <div class="infomation-wrap">
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
                <div class="mail-wrap">
                    <span v-html="content"></span>
                </div>
            </div>
            <div class="process-wrap" v-if="status === 'pending'">
                <button
                    type="button"
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAccepted"
                    @click="onConfirm"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        height="1.1rem"
                        width="1.1rem"
                        fill="#fff"
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
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        height="1.1rem"
                        width="1.1rem"
                        fill="#fff"
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
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="40"
                                    width="40"
                                    viewBox="0 0 512 512"
                                    fill="#dc3545"
                                >
                                    <path
                                        d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"
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
                class="process-wrap-after"
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
                <div class="process-wrap-after-text accepted">
                    Đơn đã được chấp nhận!
                </div>
            </div>
            <div
                class="process-wrap-after"
                v-else-if="status === 'Tu choi'"
                id="rejected"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="40"
                    width="40"
                    viewBox="0 0 512 512"
                    fill="#dc3545"
                >
                    <path
                        d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"
                    />
                </svg>
                <div
                    style="display: block"
                    class="process-wrap-after-text rejected"
                >
                    Đơn đã bị từ chối!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import JSEncrypt from "jsencrypt";
import cryptoJs from "crypto-js";

const key = '82f2ceed4c503896c8a291e560bd4325' // change to your key
const iv = 'sinasinasisinaaa' // change to your iv

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
                // let encrypt = new JSEncrypt();
                // encrypt.setPublicKey(this.publicKey);
                // let encryptedParams = encrypt.encrypt(
                //     `permission/confirm/${this.id}?isAuth=${isAuth}`
                // );

                const txt = `permission/confirm/${this.id}?isAuth=${isAuth}`;
                const cipher = cryptoJs.AES.encrypt(txt, cryptoJs.enc.Utf8.parse(key), {
                        iv: cryptoJs.enc.Utf8.parse(iv),
                        mode: cryptoJs.mode.CBC
                    })

                console.log("cipher " + cipher)

                let apiRequest = `${apiPath}/${cipher}`;
                // let apiRequest = `${apiPath}/permission/confirm/${this.id}?isAuth=${isAuth}`;
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
                let apiRequest = `${apiPath}/permission/reject/${this.id}?isAuth=${isAuth}`;
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
