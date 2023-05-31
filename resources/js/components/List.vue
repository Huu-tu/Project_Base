<template>
    <div>
        <Header
            :userName="user_name"
            :userAvatar="user_avatar"
            :userEmail="user_email"
        ></Header>
        <div class="container-fluid main-container">
            <div class="main-wrap list-wrap">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Tìm kiếm..."
                        aria-label="Tìm kiếm..."
                        aria-describedby="basic-addon2"
                    />
                    <div class="input-group-append">
                        <a href="javascript:void(0)" @click="onSearch">
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

                <table class="table table-responsive table-hover">
                    <tbody>
                        <ListItem
                            v-for="(item, index) in items"
                            :key="index"
                            :avatar="item.avatar"
                            :userName="item.sender"
                            :title="item.title"
                            :content="item.content"
                            :updateTime="convertDate(item.created_at)"
                            :object="item"
                            :isVisted="isNew[index]"
                            @openNew="selectMail"
                        ></ListItem>
                    </tbody>
                </table>
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
    mounted() {
        this.fetchData();
    },
    data() {
        return {
            user_name: "",
            user_avatar: "",
            user_email: "",
            items: [],
            isNew: {},
        };
    },
    methods: {
        async fetchData(item) {
            try {
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
                // console.log(respone)
                var apiPath = respone.data.data;
                this.items = apiPath;

                // var index = this.items.indexOf(item);
                // if (index !== -1) {
                //     this.items[index].isVisited = item.isVisited;
                // }
            } catch (e) {
                console.log(e);
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
        async onSearch() {
            try {
                let urlSearch = "http://127.0.0.1:8000/permission";
                let resSearch = await axios.get(urlSearch);
                console.log(resSearch);
            } catch (e) {
                console.log(e);
            }
        },
        selectMail(itemId) {
            this.isNew[itemId] = true; // Mark mail as not new
            this.selectedMail = itemId;
            console.log(this.isNew[itemId]);
            console.log(this.isNew)
        },
    },
};
</script>

<style></style>
