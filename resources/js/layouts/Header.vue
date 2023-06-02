<template>
    <div class="header-container">
        <img :src="require('../assets/images/logo_default.png')" />
        <div class="noti-container">
            <div class="dropdown">
                <svg
                    fill="#000000"
                    width="800px"
                    height="800px"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    class="dropdown-toggle"
                    role="button"
                    id="dropdownNotiButton"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <path
                        d="M10,21h4a2,2,0,0,1-4,0ZM3.076,18.383a1,1,0,0,1,.217-1.09L5,15.586V10a7.006,7.006,0,0,1,6-6.92V2a1,1,0,0,1,2,0V3.08A7.006,7.006,0,0,1,19,10v5.586l1.707,1.707A1,1,0,0,1,20,19H4A1,1,0,0,1,3.076,18.383ZM6.414,17H17.586l-.293-.293A1,1,0,0,1,17,16V10A5,5,0,0,0,7,10v6a1,1,0,0,1-.293.707Z"
                    />
                </svg>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="dropdownNotiButton"
                >
                    <li>1</li>
                </ul>
            </div>

            <div class="dropdown">
                <img
                    :src="userAvatar"
                    class="dropdown-toggle"
                    role="button"
                    id="dropdownMenuButton"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                />
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="dropdownMenuButton"
                >
                    <li>
                        <a class="dropdown-item account-info" href="#">
                            <img :src="userAvatar" />
                            <div class="account-info-wrap">
                                <div class="account-name">{{ userName }}</div>
                                <div class="account-email">{{ userEmail }}</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <!-- <router-link to="/" class="dropdown-item account-logout"
                        @click="onLogout"
                        >
                            Đăng xuất
                        </router-link> -->
                        <a
                            class="dropdown-item account-logout"
                            @click="onLogout()"
                        >
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import "../assets/styles/global.css";

export default {
    name: "Header",
    props: {
        userName: String,
        userAvatar: String,
        userEmail: String,
    },
    methods: {
        onLogout() {
            window.location.href = "http://127.0.0.1:8000/logout";
            // axios
            //     .get("http://127.0.0.1:8000/logout")
            //     .then((respone) => {
            //         console.log(respone.data);
            //     })
            //     .catch((error) => {
            //         console.log(error);
            //     });
        },
    },
};
</script>

<style></style>
