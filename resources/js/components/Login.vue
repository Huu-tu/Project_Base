<template>
    <div class="login-wrap">
        <div class="login-container">
            <img :src="require('../assets/images/PNG/logo_default.png')" />
            <div class="select-dropdown">
                <select
                    name
                    id
                    v-model="selected"
                    class="form-select"
                    @change="onChange($event)"
                >
                    <option selected hidden value>Chọn cơ sở</option>
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
                    <img :src="require('../assets/images/PNG/google.png')" />
                    Sign in with Google
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "login",
    data() {
        return {
            items: [],
            selected: "",
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        onChange(e) {
            this.selected = e.target.value;
        },
        async fetchData() {
            try {
                let apiRequest = `${apiPath}/api/campus`;
                let resRequest = (await axios.get(apiRequest)).data.data;               
                this.items = resRequest;
            } catch (e) {
                console.log(e);
            }
        },
        loginAuth() {
            window.location.href = `${apiPath}/google/login?campus_id=${this.selected}`;
        },
    },
};
</script>

<style></style>
