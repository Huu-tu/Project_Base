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
            ></Notify>
        </template>
        <template v-else-if="type === 'pheduyet'">
            <Show
                :title="index_title"
                :userName="index_userName"
                :email="index_email"
                :time="index_time"
                :content="index_content"
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
    // computed: {
    //     ...mapState(["title", "userName", "email", "time", "content"]),
    //     ...mapGetters({
    //         get_Title: "getTitle",
    //         get_UserName: "getUserName",
    //         get_Email: "getEmail",
    //         get_Time: "getTime",
    //         get_Content: "getContent",
    //     }),
    // },
    // watch: {
    //     get_Title(value) {
    //         this.title2 = value;
    //     },
    // },
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
        }
    },
    methods: {
        fetchData() {
            axios
                .get("http://127.0.0.1:8000/permission")
                .then((response) => {
                    console.log(response.data.data[0])
                    var apiPath = response.data.data[0];
                    console.log()
                    this.index_title = apiPath.title;
                    this.index_userName = apiPath.sender;
                    this.index_email = apiPath.email;
                    this.index_time = apiPath.created_at;
                    this.index_content = apiPath.content;

                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style></style>
