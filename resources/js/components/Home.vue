<template>
    <div>
        <Header></Header>
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

export default {
    name: "home",
    components: {
        Header: Header,
        Notify: Notify,
        Show: Show,
    },
    computed: {
        ...mapState(["title", "userName", "email", "time", "content"]),
        ...mapGetters({
            get_Title: "getTitle",
            get_UserName: "getUserName",
            get_Email: "getEmail",
            get_Time: "getTime",
            get_Content: "getContent",
        }),
    },
    watch: {
        get_Title(value) {
            this.title2 = value;
        },
    },
    mounted() {},
    data() {
        return {
            type: "pheduyet",
            index_title: "Xác nhận chuyển lớp cơ sở Hà Nội",
            index_userName: "Linka",
            index_email: "linka@fpt.edu.vn",
            index_time: "4:08pm 05/05/2023",
            index_content:
                "We’re excited to announce that we’re co-sponsoring $500k in awards for outstanding papers and reviewers in the Reproducibility Challenge 2022.Reproducibility is a major challenge in ML research. Reproducible results enable the scientific community to quickly verify empirical findings and incorporate new ideas. For the last 5 years, the ML Reproducibility Challenge has galvanized members of the ML community to work with authors to reproduce papers published at top conferences and to share their reports with the world.This year, Kaggle will be awarding ~50 prizes in the form of GCP compute credits totaling $500k, including $25k each to the top 5 outstanding papers, subject to eligibility criteria.",
        };
    },
    methods: {},
};
</script>

<style></style>
