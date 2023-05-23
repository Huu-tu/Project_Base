<template>
    <div>
      <Header></Header>
      <template v-if="type === 'thongbao'">
        <Notify></Notify>
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
      "Header": Header,
      "Notify": Notify,
      "Show": Show,
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
  
  <style>
  .container {
    display: flex;
    justify-content: center;
  }
  
  .main-container {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.11);
    box-shadow: inset 0px 10px 4px rgba(0, 0, 0, 0.25);
    border-radius: 50px 50px 0px 0px;
    /* border-radius: 50px; */
    width: 1000px;
    /* height: max-content; */
    height: 800px;
    margin-top: 50px;
  }
  
  .infomation-container img {
    width: 33px;
    height: 33px;
    margin-right: 20px;
  }
  
  .infomation-container {
    display: flex;
    justify-content: space-between;
    margin: 0 30px;
  }
  
  .info-wrap {
    display: flex;
    align-items: center;
  }
  
  .nav-wrap button {
    /* background: #4285f4; */
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border: none;
    border-radius: 30px;
    width: 150px;
    height: 40px;
  }
  
  .info-title {
    font-family: "Roboto";
    font-style: normal;
    font-weight: 700;
    font-size: 32px;
    line-height: 39px;
    color: var(--font-color);
    margin: 50px 30px 10px;
  }
  
  .info-name,
  .info-mail,
  .info-time {
    margin-right: 20px;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 39px;
    color: var(--font-color);
  }
  
  .info-mail {
    font-size: 16px;
    font-weight: 400;
  }
  
  .info-time {
    display: flex;
    align-items: center;
    font-size: 20px;
    font-weight: 500;
  }
  
  .mail-wrap {
    margin: 20px;
    font-family: "Roboto";
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 24px;
  }
  
  .nav-wrap {
    margin-left: 20px;
  }
  
  .nav-wrap button {
    font-family: "Roboto";
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 24px;
    margin-right: 16px;
    margin-bottom: 30px;
  }
  
  /* .list-wrap {
    width: 1000px;
    height: 500px;
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.11);
    box-shadow: inset 0px 10px 4px rgba(0, 0, 0, 0.25);
    border-radius: 50px 50px 0px 0px;
    margin-top: 50px;
  }
  
  .list-wrap input {
    width: 500px;
    height: 60px;
  }
  
  table {
    width: 100%;
  }
  
  th img {
    width: 40px;
    height: 40px;
  }
  
  tr {
    display: flex;
    justify-content: space-between;
  } */
  </style>