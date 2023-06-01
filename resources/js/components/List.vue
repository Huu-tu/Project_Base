<template>
    <div>
        <Header
            :userName="user_name"
            :userAvatar="user_avatar"
            :userEmail="user_email"
        ></Header>
        <div class="container-fluid main-container">
            <div class="spinner-wrap" v-if="loading">
                <div class="overlay"></div>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <!-- <div class="spinner-text">ĐANG XỬ LÝ YÊU CẦU</div> -->
            </div>

            <div class="main-wrap list-wrap" v-if="!loading">
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Tìm kiếm..."
                        aria-label="Tìm kiếm..."
                        aria-describedby="basic-addon2"
                        autocomplete="on"
                        v-model="keyword"
                        @keyup.enter="onSearch(keyword)"
                    />
                    <div class="input-group-append">
                        <a href="javascript:void(0)" @click="onSearch(keyword)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                                width="24"
                                height="24"
                            >
                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <ListItem
                                v-for="(item, index) in items"
                                :key="index"
                                :avatar="`https://ui-avatars.com/api/?background=random&name=${encodeURIComponent(
                                    item.sender
                                )}&rounded=true&?bold=true`"
                                :userName="item.sender"
                                :title="item.title"
                                :content="item.content"
                                :updateTime="convertDate(item.created_at)"
                                :idRequest="item.id"
                                @onFetchData="fetchData"
                                :isChecked="item.is_checked"
                            ></ListItem>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import ListItem from "../components/ListItem.vue";
import axios from "axios";

export default {
    name: "list",
    components: {
        Header: Header,
        ListItem: ListItem,
    },
    // setup() {
    //     onMounted((getProducts) => {

    //     }),
    // }
    mounted() {
        this.fetchData();
    },
    data() {
        return {
            user_name: "",
            user_avatar: "",
            user_email: "",
            items: [],
            keyword: null,
            loading: true,
        };
    },
    methods: {
        async fetchData() {
            try {
                this.loading = true;
                //user
                let urlUser = "http://127.0.0.1:8000/info-user";
                let responseUser = await axios.get(urlUser);
                var apiUser = responseUser.data;
                // console.log(apiUser)
                this.user_avatar = apiUser.avatar;
                this.user_name = apiUser.name;
                this.user_email = apiUser.email;
                //permission

                let url = `http://127.0.0.1:8000/permissions`;
                let respone = await axios.get(url);
                console.log(respone);
                var apiPath = respone.data.data;

                apiPath.sort((a, b) => {
                    return new Date(b.created_at) - new Date(a.created_at);
                });
                // let arr = [];
                // arr.push(apiPath[0]);
                // console.log(arr)
                // this.items = arr
                this.items = apiPath;
                
                this.loading = false;
            } catch (e) {
                console.log(e);
                this.loading = false;
            }
        },
        convertDate(inputDate) {
            let date = new Date(inputDate);
            // Chuyển đổi sang định dạng AM/PM
            let hours = date.getHours() % 12 || 12;
            let minutes = date.getMinutes();
            let period = date.getHours() >= 12 ? "pm" : "am";
            // Chuyển đổi sang định dạng ngày/tháng/năm
            let day = date.getDate();
            let month = date.getMonth() + 1; // Tháng trong JavaScript đếm từ 0, nên cần +1
            let year = date.getFullYear();
            // Xuất giờ cuối cùng
            let outputDate = `${hours}:${minutes
                .toString()
                .padStart(2, "0")}${period} ${day
                .toString()
                .padStart(2, "0")}/${month
                .toString()
                .padStart(2, "0")}/${year}`;
            return outputDate;
        },
        async onSearch(keyword) {
            try {
                let urlSearch = "http://127.0.0.1:8000/permission";
                let resSearch = await axios.get(urlSearch, {
                    params: { keyword: keyword },
                });
                console.log(resSearch);
                this.items = resSearch.data.data;
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>

<style></style>
