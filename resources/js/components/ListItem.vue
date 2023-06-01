<template>
    <tr
        @click="openNew"
        class="tr-default"
        v-if="isRespon === false"
        :class="{ newItem: isChecked === 0 }"
    >
        <td scope="col">
            <img :src="avatar" />
        </td>
        <td scope="col">
            <div class="msg-name">{{ userName }}</div>
        </td>
        <td scope="col">
            <div class="msg-title">{{ title }}</div>
        </td>
        <td scope="col">
            <div class="msg-updatetag" :class="{ hidden: isChecked === 1 }">
                {{ updateTag }}
            </div>
        </td>
        <td scope="col" class="msg-content-wrap">
            <div class="msg-content">{{ content }}</div>
        </td>
        <td scope="col">
            <div class="msg-time">{{ updateTime }}</div>
        </td>
    </tr>
    <tr
        class="tr-responsive"
        v-else
        :class="{ newItem: isChecked === 0 }"
        @click="openNew"
    >
        <td scope="col"><img :src="avatar" /></td>
        <td scope="col" class="msg-responsive-wrap">
            <div class="msg-name-responsive">
                <div class="msg-name-wrap-res">
                    {{ userName }}
                </div>
            </div>
            <div class="msg-title-responsive">
                <div class="msg-title-wrap-res">
                    {{ title }}
                </div>
                <span class="badge" :class="{ hidden: isChecked === 1 }">New</span>
            </div>
            <div class="msg-content-responsive">
                <div class="msg-content-wrap-res">{{ content }}</div>
            </div>
        </td>
        <td scope="col">
            <div class="msg-time-responsive">
                {{ updateTime }}
            </div>
        </td>
    </tr>
</template>

<script>
import axios from "axios";

export default {
    props: {
        avatar: String,
        userName: String,
        title: String,
        content: String,
        updateTime: String,
        isChecked: null,
        idRequest: null,
    },
    data() {
        return {
            isRespon: false,
            updateTag: "New",
        };
    },
    created() {
        // window.addEventListener("resize", this.myEventHandler);
        const mediaQuery = window.matchMedia("(max-width: 768px)");
        mediaQuery.addListener(this.myEventHandler);
        this.myEventHandler(mediaQuery);
    },
    destroyed() {
        const mediaQuery = window.matchMedia("(max-width: 768px)");
        mediaQuery.removeListener(this.myEventHandler);
    },
    methods: {
        async openNew() {
            try {
                let url = `http://127.0.0.1:8000/permission/is_checked/${this.idRequest}`;
                // console.log(this.idRequest)
                let res = await axios.get(url);
                console.log("res", res);
                this.onFetchData();
                this.$router.push(`/home/${this.idRequest}`);
            } catch (e) {
                console.log(e);
            }
        },
        onFetchData() {
            this.$emit("onFetchData");
        },
        // myEventHandler() {
        //     if (window.innerWidth < 768) {
        //         this.isRespon = true;
        //     } else {
        //         this.isRespon = false;
        //     }
        // },
        myEventHandler(mediaQuery) {
            this.isRespon = mediaQuery.matches;
        },
    },
};
</script>

<style></style>
