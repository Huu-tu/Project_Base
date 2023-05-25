<template>
    <div>
        <Header :userName="index_userName"></Header>
        <template v-if="type === 'thongbao'">
            <Notify
                :title="index_title"
                :userName="index_userName"
                :email="index_email"
                :time="index_time"
                :content="index_content"
                :status="index_status"
            ></Notify>
        </template>
        <template v-else-if="type === 'pheduyet'">
            <Show
                :title="index_title"
                :userName="index_userName"
                :email="index_email"
                :time="index_time"
                :content="index_content"
                :status="index_status"
                :id="index_id"
            ></Show>
        </template>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import Notify from "../components/Notify.vue";
import Show from "../components/Show.vue";
import { mapState, mapGetters } from "vuex";
import axios from "axios";

export default {
    name: "home",
    components: {
        Header: Header,
        Notify: Notify,
        Show: Show,
    },
    mounted() {
        this.fetchData();
    },
    data() {
        return {
            type: "pheduyet",
            index_title: "",
            index_userName: "",
            index_email: "",
            index_time: "",
            index_content: "",
            index_status: "",
            index_id: "",
        };
    },
    methods: {
        fetchData() {
            let post_id = this.$route.params.id;
            let dateObj = new Date();
            let formattedDate = dateObj.toLocaleDateString("en-US", {
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
            });
            let formattedTime = dateObj.toLocaleTimeString("en-US", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
            });
            axios
                .get(`http://127.0.0.1:8000/permission/${post_id}`)
                .then((response) => {
                    console.log(response.data.data[0]);
                    var apiPath = response.data.data[0];
                    this.index_title = apiPath.title;
                    this.index_userName = apiPath.sender;
                    this.index_email = apiPath.email;
                    apiPath.time = `${formattedDate} ${formattedTime}`;
                    this.index_time = apiPath.time;
                    this.index_content = apiPath.content;
                    this.index_id = apiPath.id;
                    this.index_status = apiPath.status;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style></style>
