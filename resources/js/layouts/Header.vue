<template>
    <div class="header-container">
        <img :src="require('../assets/images/logo_default.png')" />
        <div class="noti-container" v-if="!authFlag">
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
                    <li>Lorem ipsum text</li>
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
        <div class="noti-container login-required" v-if="authFlag">
            <router-link to="/">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="1em"
                    viewBox="0 0 512 512"
                    fill="#394867"
                >
                    <path
                        d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"
                    />
                </svg>
            </router-link>
        </div>
    </div>
</template>

<script>
const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Header",
    props: {
        userName: String,
        userAvatar: String,
        userEmail: String,
        authFlag: Boolean,
    },
    methods: {
        onLogout() {
            window.location.href = `${apiPath}/logout`;
        },
    },
};
</script>

<style></style>
