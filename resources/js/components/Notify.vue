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
        status: Number,
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
