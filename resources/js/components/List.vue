<template>
    <div>
        <Header
            :userName="userName"
            :userAvatar="userAvatar"
            :userEmail="userEmail"
        ></Header>
        <div class="container-fluid main-container">
            <div class="spinner-wrap" v-if="loadSpinner">
                <div class="overlay"></div>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="list-wrap" v-if="!loadSpinner">
                <div class="input-group" :class="{ focused: inputFocus }">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Tìm kiếm..."
                        aria-label="Tìm kiếm..."
                        aria-describedby="basic-addon2"
                        autocomplete="on"
                        v-model="keyword"
                        ref="inputText"
                        @keyup.enter="onSearch(keyword)"
                        :class="typed"
                        @blur="inputFocus = false"
                        @focus="inputFocus = true"
                    />
                    <div class="input-group-append">
                        <a @click="onSearch(keyword)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                                width="1rem"
                                height="1rem"
                                fill="#fff"
                            >
                                <path
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="table-wrapper">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <ListItem
                                    v-for="(item, index) in items"
                                    :key="index"
                                    :id="item.id"
                                    :title="item.title"
                                    :content="item.content"
                                    :sender="item.sender"
                                    :createdAt="convertDate(item.created_at)"
                                    :avatar="`https://ui-avatars.com/api/?background=random&name=${encodeURIComponent(
                                        item.sender
                                    )}&rounded=true&?bold=true`"
                                    :isChecked="item.is_checked"
                                    @onFetchData="fetchData"
                                ></ListItem>
                            </tbody>
                        </table>
                        <div class="error-wrap" v-if="errorFlag">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                height="1em"
                                viewBox="0 0 640 512"
                            >
                                <path
                                    d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L489.3 358.2l90.5-90.5c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114l-96 96-31.9-25C430.9 239.6 420.1 175.1 377 132c-52.2-52.3-134.5-56.2-191.3-11.7L38.8 5.1zM239 162c30.1-14.9 67.7-9.9 92.8 15.3c20 20 27.5 48.3 21.7 74.5L239 162zM406.6 416.4L220.9 270c-2.1 39.8 12.2 80.1 42.2 110c38.9 38.9 94.4 51 143.6 36.3zm-290-228.5L60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5l61.8-61.8-50.6-39.9z"
                                />
                            </svg>
                            Không tồn tại kết quả!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import ListItem from "../components/ListItem.vue";
import axios from "axios";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "list",
    components: {
        Header: Header,
        ListItem: ListItem,
    },
    mounted() {
        this.fetchData();
    },
    computed: {
        typed() {
            return this.keyword.length > 0 ? "typed" : "";
        },
    },
    data() {
        return {
            userName: "",
            userAvatar: "",
            userEmail: "",
            items: [],
            keyword: "",
            loadSpinner: true,
            inputFocus: false,
            errorFlag: false,
        };
    },
    methods: {
        async fetchData() {
            try {
                this.loadSpinner = true;
                //user
                let isAuth = this.$route.query.param;
                let apiUser = `${apiPath}/info-user?isAuth=${isAuth}`;
                let resUser = (await axios.get(apiUser)).data;

                this.userAvatar = resUser.avatar;
                this.userName = resUser.name;
                this.userEmail = resUser.email;

                //permission
                let apiRequest = `${apiPath}/permissions?isAuth=${isAuth}`;
                let resRequest = (await axios.get(apiRequest)).data.data;

                resRequest.sort((a, b) => {
                    return new Date(b.created_at) - new Date(a.created_at);
                });
                this.items = resRequest;

                this.loadSpinner = false;
            } catch (e) {
                console.log(e);
                this.loadSpinner = false;
            }
        },
        convertDate(inputDate) {
            let date = new Date(inputDate);
            // Chuyển đổi sang định dạng AM/PM
            let hours = date.getHours() % 12 || 12;
            let minutes = date.getMinutes();
            let period = date.getHours() >= 12 ? " PM" : " AM";
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
                let apiSearch = `${apiPath}/permission`;
                let resSearch = (
                    await axios.get(apiSearch, {
                        params: { keyword: keyword },
                    })
                ).data.data;

                console.log(resSearch);
                this.items = resSearch;
                this.items.length == 0
                    ? (this.errorFlag = true)
                    : (this.errorFlag = false);
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>

<style></style>
