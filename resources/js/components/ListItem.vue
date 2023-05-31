<template>
    <tr @click="openNew" class="tr-default" v-if="isRespon === false">
        <td scope="col">
            <img :src="require('../assets/images/google.png')" />
        </td>
        <td scope="col">{{ userName }}</td>
        <td class="msg-title" scope="col">{{ title }}</td>
        <td scope="col">
            <div class="msg-updatetag" v-if="isChecked === false">
                {{ updateTag }}
            </div>
        </td>
        <td class="msg-content" scope="col">{{ content }}</td>
        <td class="msg-time" scope="col">{{ updateTime }}</td>
    </tr>
    <tr class="tr-responsive" v-else>
        <td><img :src="require('../assets/images/google.png')" /></td>
        <td>
            <div class="msg-name-responsive">{{ userName }}</div>
            <div class="msg-title-responsive">{{ title }}</div>
            <div class="msg-content-responsive">{{ content }}</div>
        </td>
        <td class="msg-time">{{ updateTime }}</td>
    </tr>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        avatar: String,
        userName: String,
        title: String,
        content: String,
        updateTime: String,
        isChecked: Boolean,
        idRequest: null,
    },
    data() {
        return {
            isRespon: false,
            updateTag: "New",
        };
    },
    created() {
        window.addEventListener("resize", this.myEventHandler);
    },
    destroyed() {
        window.removeEventListener("resize", this.myEventHandler);
    },
    methods: {
        async openNew() {
            try {
                let url = `http://127.0.0.1:8000/permission/confirm/${this.idRequest}`;
                // console.log(this.idRequest)
                let res = await axios.get(url);
                console.log("res", res);
                this.onFetchData();
            } catch (e) {
                console.log(e);
            }
        },
        onFetchData() {
            this.$emit("onFetchData");
        },
        myEventHandler() {
            if (window.innerWidth < 768) {
                this.isRespon = true;
            } else {
                this.isRespon = false;
            }
        },
    },
};
</script>

<style></style>
