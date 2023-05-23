<template>
    <div class="container">
    <div class="main-container">
      <div class="infomation-wrap">
        <div class="info-title">Xác nhận chuyển lớp cơ sở</div>
        <div class="infomation-container">
          <div class="info-wrap">
            <img :src="require('../assets/google.png')" />
            <div class="info-name">Linka</div>
            <div class="info-mail">&lt;hello@fpt.edu.vn&gt;</div>
          </div>
          <div class="info-time">4:08pm 05/05/2023</div>
        </div>
      </div>
      <div class="mail-wrap">
        We’re excited to announce that we’re co-sponsoring $500k in awards for
        outstanding papers and reviewers in the Reproducibility Challenge
        2022.Reproducibility is a major challenge in ML research. Reproducible
        results enable the scientific community to quickly verify empirical
        findings and incorporate new ideas. For the last 5 years, the ML
        Reproducibility Challenge has galvanized members of the ML community
        to work with authors to reproduce papers published at top conferences
        and to share their reports with the world.This year, Kaggle will be
        awarding ~50 prizes in the form of GCP compute credits totaling $500k,
        including $25k each to the top 5 outstanding papers, subject to
        eligibility criteria.
      </div>
      <!-- <div class="nav-wrap">
        <b-button class="accept btn btn-primary" v-b-modal.accepted
        
        @click="showModal(myModal1)"
          >Xác nhận</b-button
        >
        <b-modal id="accepted" ref="myModal1">
          <p class="my-4">1</p>
        </b-modal>
        <b-button class="decline btn btn-danger" v-b-modal.declined
        @click="showModal(myModal2)"
        >Từ chối</b-button>
        <b-modal id="declined" ref="myModal2">
          <p class="my-4">2</p>
        </b-modal>
      </div> -->
    </div>
  </div>
</template>

<script>
export default {
  name: "Notify",
}
</script>

<style>

</style>