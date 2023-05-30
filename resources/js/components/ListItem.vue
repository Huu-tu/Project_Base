<template>
  <tr @click="openNew" class="tr-default" v-if="isRespon === false">
    <td scope="col"><img :src="require('../assets/images/google.png')" /></td>
    <td scope="col">{{ userName }}</td>
    <td class="msg-title" scope="col">{{ title }}</td>
    <td scope="col">
      <div class="msg-updatetag">{{ updateTag }}</div>
    </td>
    <td class="msg-content" scope="col">{{ content }}</td>
    <td class="msg-time" scope="col">{{ updateTime }}</td>
  </tr>
  <tr @click="openNew" class="tr-responsive" v-else>
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
export default {
  props: {
    avatar: String,
    userName: String,
    title: String,
    updateTag: String,
    content: String,
    updateTime: String,
  },
  data() {
    return {
      isRespon: false,
    };
  },
  created() {
    window.addEventListener("resize", this.myEventHandler);
  },
  destroyed() {
    window.removeEventListener("resize", this.myEventHandler);
  },
  methods: {
    openNew() {
      this.$router.push("/home");
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
