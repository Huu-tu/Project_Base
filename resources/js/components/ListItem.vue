<template>
    <tr
        @click="openNew"
        class="tr-default"
        v-if="!isResponsive"
        :class="{ newItem: isChecked === 0 }"
    >
        <td>
            <img :src="avatar" />
        </td>
        <td>
            <div class="msg-name">{{ sender }}</div>
        </td>
        <td>
            <div class="msg-title">{{ title }}</div>
        </td>
        <td>
            <div class="msg-updatetag" :class="{ hidden: isChecked === 1 }">
                {{ updateTag }}
            </div>
        </td>
        <td class="msg-content-wrap">
            <div class="msg-content">{{ content }}</div>
        </td>
        <td>
            <div class="msg-time">{{ createdAt }}</div>
        </td>
    </tr>
    <tr
        class="tr-responsive"
        v-else
        :class="{ newItem: isChecked === 0 }"
        @click="openNew"
    >
        <td><img :src="avatar" /></td>
        <td class="msg-responsive-wrap">
            <div class="msg-name-responsive">
                <div class="msg-name-wrap-res">
                    {{ sender }}
                </div>
            </div>
            <div class="msg-title-responsive">
                <div class="msg-title-wrap-res">
                    {{ title }}
                </div>
                <span class="badge" :class="{ hidden: isChecked === 1 }">
                    {{ updateTag }}</span
                >
            </div>
            <div class="msg-content-responsive">
                <div class="msg-content-wrap-res">{{ content }}</div>
            </div>
        </td>
        <td>
            <div class="msg-time-responsive">
                {{ createdAt }}
            </div>
        </td>
    </tr>
</template>

<script>
import axios from "axios";

const mediaQuery = window.matchMedia("(max-width: 768px)");
const apiPath = process.env.MIX_API_PATH;

export default {
    props: {
        id: Number,
        title: String,
        content: String,
        sender: String,
        createdAt: String,
        avatar: String,
        isChecked: Number,
    },
    data() {
        return {
            isResponsive: false,
            updateTag: "New",
        };
    },
    created() {
        mediaQuery.addEventListener("change", this.myEventHandler);
        this.myEventHandler(mediaQuery);
    },
    destroyed() {
        mediaQuery.removeEventListener("change", this.myEventHandler);
    },
    methods: {
        async openNew() {
            try {
                let isAuth = this.$route.query.param;
                let apiRequest = `${apiPath}/permission/is_checked/${this.id}?param=${isAuth}`;
                let resRequest = await axios.get(apiRequest);
                console.log("res", resRequest);

                this.onFetchData();
                this.$router.push(`/home/${this.id}`);
            } catch (e) {
                console.log(e);
            }
        },
        onFetchData() {
            this.$emit("onFetchData");
        },
        myEventHandler(mediaQuery) {
            this.isResponsive = mediaQuery.matches;
        },
    },
};
</script>

<style></style>
