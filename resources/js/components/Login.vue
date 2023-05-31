<template>
    <div class="login-wrap">
        <div class="login-container">
            <img :src="require('../assets/images/logo_default.png')" />
            <div class="select-dropdown">
                <select name="" id="" v-model="selected" class="form-select" @change="onChange($event)">
                    <option selected hidden value="">
                        Chọn cơ sở
                    </option>
                    <option
                        v-for="(item, index) in items"
                        :key="index"
                        :value="item.content"
                    >
                        {{ item.content }}
                    </option>
                </select>
            </div>
            <div class="google-login">
                <a class="login-text" @click="loginAuth()">
                    <img :src="require('../assets/images/google.png')" />
                    <!-- <button type="button" class="login-text" onclick="">
                    Sign in with Google
                </button> -->
                    Sign in with Google
              </a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import "../assets/styles/global.css";

export default { 
   name:'login',
   data() {
      return { 
        items: [],
        selected: '',
        onChange(e) {
              // console.log(e.target.value);
              this.selected = e.target.value
        }
      }
   },
   mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get('http://127.0.0.1:8000/api/campus')
        .then(response => {
          this.items = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    loginAuth : function() {
      window.location.href = 'http://127.0.0.1:8000/google/login?campus_id=' + this.selected;
    }
  },
 }
</script>

<style></style>
