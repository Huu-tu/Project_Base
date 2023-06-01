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
                        <div class="info-name">{{ userName }}</div>
                        <div class="info-mail">&lt;{{ email }}&gt;</div>
                    </div>
                    <div class="info-time">{{ time }}</div>
                </div>
            </div>
            <div class="mail-wrap">
                {{ content }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Notify",
    props: {
        title: String,
        userName: String,
        email: String,
        time: String,
        content: String,
        status: String,
        avatar: String,
        id_request: null,
    },
    methods: {
        onBackClick() {
            this.$router.push("/list");
        },
    }
};
</script>

<style></style>
