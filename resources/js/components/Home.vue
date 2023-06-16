<template>
    <div>
        <Header
            :userName="userName"
            :userAvatar="userAvatar"
            :userEmail="userEmail"
            :authFlag="authFlag"
        ></Header>
        <div class="spinner-wrap" v-if="loadSpinner">
            <div class="overlay"></div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <!-- <div class="spinner-text">ĐANG XỬ LÝ YÊU CẦU</div> -->
        </div>
        
        <template v-if="requestType === 0 && !loadSpinner">
            <Notify
                :id="requestId"
                :title="requestTitle"
                :content="requestContent"
                :email="requestEmail"
                :sender="requestSender"
                :status="requestStatus"
                :createdAt="requestCreatedTime"
                :party="requestParty"
                :avatar="requestAvatar"
                :authFlag="authFlag"
            ></Notify>
        </template>
        <template v-else-if="requestType === 1 && !loadSpinner">
            <Show
                :id="requestId"
                :title="requestTitle"
                :content="requestContent"
                :email="requestEmail"
                :sender="requestSender"
                :status="requestStatus"
                :createdAt="requestCreatedTime"
                :party="requestParty"
                :avatar="requestAvatar"
                :authFlag="authFlag"
                @onFetchData="fetchData"
            ></Show>
        </template>
        <template v-else-if="requestType === 2 && !loadSpinner">
            <Discussion
                :id="requestId"
                :title="requestTitle"
                :content="requestContent"
                :email="requestEmail"
                :sender="requestSender"
                :status="requestStatus"
                :createdAt="requestCreatedTime"
                :party="requestParty"
                :avatar="requestAvatar"
                :authFlag="authFlag"
            ></Discussion>
        </template>
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import Notify from "../components/Notify.vue";
import Show from "../components/Show.vue";
import Discussion from "../components/Discussion.vue";
import axios from "axios";
// import JSEncrypt from "jsencrypt";
// import CryptoJS from "crypto-js";
import { convertDate } from "../convert.js";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "home",
    components: {
        Header: Header,
        Notify: Notify,
        Show: Show,
        Discussion: Discussion,
    },
    mounted() {
        this.fetchData();
    },
    data() {
        return {
            requestId: "",
            requestTitle: "",
            requestContent: "",
            requestEmail: "",
            requestSender: "",
            requestStatus: "",
            requestCreatedTime: "",
            requestType: "",
            requestParty: "",
            requestAvatar: "",

            userName: "",
            userAvatar: "",
            userEmail: "",

            loadSpinner: "",
            authFlag: false,
        };
    },
    methods: {
        async fetchData() {
            try {
                this.loadSpinner = true;

                let permissionId = this.$route.params.id;
                let isAuth = this.$route.query.param;
                let flagCheck = this.$route.fullPath;

                flagCheck.includes("isAuth")
                    ? (this.authFlag = true)
                    : (this.authFlag = false);

                // /*Encode for params (?)*/
                // let encrypt = new JSEncrypt();
                // encrypt.setPrivateKey(this.privateKey);

                // let encryptedParams = encrypt.encrypt(
                //     `${isAuth}`
                // );
                // console.log("encryptedParams " + encryptedParams);
                // let encodedParams = encodeURIComponent(
                //     window.btoa(encryptedParams)
                // );
                // console.log("encode " + encodedParams);
                // // let apiRequest = `${apiPath}/permission/${encodedParams}`;
                let apiRequest = `${apiPath}/permission/${permissionId}?isAuth=${isAuth}`;
                let resRequest = (await axios.get(apiRequest)).data.data[0];

                // /*End encode for params */

                // /*Encode for json */

                // let jsonString = JSON.stringify(resRequest);
                // let encrypteJson = encrypt.encrypt(jsonString);
                // console.log("encrypteJson: " + encrypteJson)

                // let encodeJson = encodeURIComponent(window.btoa(encrypteJson));
                // console.log("encodeJson: " + encodeJson)

                // let symmetricKey = CryptoJS.lib.WordArray.random(16).toString(); // Generate a random 128-bit AES key
                // // console.log("symmetric " + symmetricKey);

                // let encryptedJson = CryptoJS.AES.encrypt(
                //     jsonString,
                //     symmetricKey
                // ).toString();

                // // console.log("encrypted Json: " + encryptedJson);

                // // Encrypt the symmetric key using RSA
                // let encryptedSymmetricKey = encrypt.encrypt(
                //     symmetricKey.toString()
                // );
                // console.log(
                //     "encrypted Symmetric Key: " + encryptedSymmetricKey
                // );
                /* End encode for json */

                /* Decode for json */
                // let decrypt = new JSEncrypt();
                // decrypt.setPrivateKey(this.privateKey);
                // let decryptedSymmetricKey = decrypt.decrypt(
                //     encryptedSymmetricKey
                // );
                // // console.log("decryptedSymmetricKey: " + decryptedSymmetricKey);
                // // Decrypt the JSON data using AES
                // let decryptedJson = CryptoJS.AES.decrypt(
                //     encryptedJson,
                //     decryptedSymmetricKey
                // );
                // let jsonStringDecoded = decryptedJson.toString(
                //     CryptoJS.enc.Utf8
                // );
                // let decryptedData = JSON.parse(jsonStringDecoded);
                // console.log("decryptedData: " + decryptedData);

                /* End decode for json */

                this.requestAvatar = `https://ui-avatars.com/api/?background=random&name=${encodeURIComponent(
                    resRequest.sender
                )}&rounded=true&?bold=true`;
                this.requestTitle = resRequest.title;
                this.requestSender = resRequest.sender;
                this.requestEmail = resRequest.email;
                this.requestCreatedTime = convertDate(resRequest.created_at);
                this.requestContent = resRequest.content;
                this.requestId = resRequest.id;
                this.requestStatus = resRequest.status;
                this.requestParty = resRequest.party;
                this.requestType = resRequest.type;

                let apiUser = `${apiPath}/info-user?isAuth=${isAuth}`;
                let resUser = (await axios.get(apiUser)).data;

                this.userAvatar = resUser.avatar;
                this.userName = resUser.name;
                this.userEmail = resUser.email;

                this.loadSpinner = false;
            } catch (error) {
                console.log(error);
                this.loadSpinner = false;
            }
        },
    },
};
</script>

<style></style>
