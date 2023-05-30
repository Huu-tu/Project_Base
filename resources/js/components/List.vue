<template>
    <div>
        <Header
            :userName="user_name"
            :userAvatar="user_avatar"
            :userEmail="user_email"
        ></Header>
        <div class="container-fluid">
            <div class="main-container">
                <div class="input-group mb-3 col-md-8">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Tìm kiếm..."
                        aria-label="Tìm kiếm..."
                        aria-describedby="basic-addon2"
                    />
                    <div class="input-group-append">
                        <a href="javascript:void(0)">
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
                            :userName="item.userName"
                            :title="item.title"
                            :updateTag="item.updateTag"
                            :content="item.content"
                            :updateTime="item.updateTime"
                        ></ListItem>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import ListItem from "../components/ListItem.vue"
export default {
    name: "main-list",
    components: {
        Header: Header,
        ListItem: ListItem,
    },
    data() {
        return {
            items: [
                {
                    avatar: "google.png",
                    userName: "Quangdn",
                    title: "Xác nhận đơn TUVH",
                    updateTag: "new",
                    content:
                        "- Dear anh Thành, Hôm nay nhân dịp 8/3, chúng ta nên tổ chức cho chị em Dear anh Thành, Hôm nay nhân dịp 8/3, chúng ta nên tổ chức cho chị emDear anh Thành, Hôm nay nhân dịp 8/3, chúng ta nên tổ chức cho chị emDear anh Thành, Hôm nay nhân dịp 8/3, chúng ta nên tổ chức cho chị emDear anh Thành, Hôm nay nhân dịp 8/3, chúng ta nên tổ chức cho chị em",
                    updateTime: "8:30pm 5/5/2023",
                },
                {
                    avatar: "google.png",
                    userName: "Quangdn",
                    title: "Xác nhận đơn TUVH",
                    updateTag: "new",
                    content:
                        "- Dear anh Thành, Hôm nay nhân dịp 8/3, chúng ta nên tổ chức cho chị em ....",
                    updateTime: "8:30pm 5/5/2023",
                },
                {
                    avatar: "google.png",
                    userName: "Quangdn",
                    title: "Xác nhận đơn TUVH",
                    updateTag: "new",
                    content:
                        "- Dear anh Thành, Hôm nay nhân dịp 8/3, chúng ta nên tổ chức cho chị em ....",
                    updateTime: "8:30pm 5/5/2023",
                },
            ],
        };
    },
};
</script>

<style></style>
