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
                    {{ content }}
                </div>
            </div>
            <div style="padding-bottom: 4rem"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Notify",
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
        onBackClick() {
            this.$router.push("/list");
        },
    },
};
</script>

<style></style>
