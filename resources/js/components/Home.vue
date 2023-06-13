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
        <template v-if="requestType === '2' && !loadSpinner">
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
        <template v-else-if="requestType === '1' && !loadSpinner">
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
    </div>
</template>

<script>
import Header from "../layouts/Header.vue";
import Notify from "../components/Notify.vue";
import Show from "../components/Show.vue";
import axios from "axios";
import JSEncrypt from "jsencrypt";
import CryptoJS from "crypto-js";
import { convertDate } from "../convert.js";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "home",
    components: {
        Header: Header,
        Notify: Notify,
        Show: Show,
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
            publicKey:
                "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC+6Lkd8xoz1uPrbClQACWTFI2J +6DoY32PgV0YgMkwwVtBD8AJOTHnPh5ZZFTXmq9xrLGXT9O6I+PtxkybUYUv4/dd iKzjYaxy3zF00sWIx0RaevIw0HmoH1sTQDxArHFke/jFpLWbV0OQTvBNBjAwD8Ot twVW0jfNdjF85n06JQIDAQAB",
            privateKey:
                "MIIBOgIBAAJBAKj34GkxFhD90vcNLYLInFEX6Ppy1tPf9Cnzj4p4WGeKLs1Pt8Qu KUpRKfFLfRYC9AIKjbJTWit+CqvjWYzvQwECAwEAAQJAIJLixBy2qpFoS4DSmoEm o3qGy0t6z09AIJtH+5OeRV1be+N4cDYJKffGzDa88vQENZiRm0GRq6a+HPGQMd2k TQIhAKMSvzIBnni7ot/OSie2TmJLY4SwTQAevXysE2RbFDYdAiEBCUEaRQnMnbp7 9mxDXDf6AU0cN/RPBjb9qSHDcWZHGzUCIG2Es59z8ugGrDY+pxLQnwfotadxd+Uy v/Ow5T0q5gIJAiEAyS4RaI9YG8EWx/2w0T67ZUVAw8eOMB6BIUg0Xcu+3okCIBOs /5OiPgoTdSy7bcF9IGpSE8ZgGKzgYQVZeN97YE00",
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

                /*Encode for params (?)*/
                let encrypt = new JSEncrypt();
                encrypt.setPrivateKey(this.privateKey);

                let encryptedParams = encrypt.encrypt(
                    `${permissionId}?isAuth=${isAuth}`
                );
                console.log("encryptedParams " + encryptedParams);
                let encodedParams = encodeURIComponent(
                    window.btoa(encryptedParams)
                );
                console.log("encode " + encodedParams);
                // let apiRequest = `${apiPath}/permission/${encodedParams}`;

                let apiRequest = `${apiPath}/permission/${permissionId}?isAuth=${isAuth}`;
                let resRequest = (await axios.get(apiRequest)).data.data[0];

                /*End encode for params */

                /*Encode for json */

                let jsonString = JSON.stringify(resRequest);
                let encrypteJson = encrypt.encrypt(jsonString);
                console.log("encrypteJson: " + encrypteJson)

                let encodeJson = encodeURIComponent(window.btoa(encrypteJson));
                console.log("encodeJson: " + encodeJson)

                let symmetricKey = CryptoJS.lib.WordArray.random(16).toString(); // Generate a random 128-bit AES key
                // console.log("symmetric " + symmetricKey);

                let encryptedJson = CryptoJS.AES.encrypt(
                    jsonString,
                    symmetricKey
                ).toString();

                // console.log("encrypted Json: " + encryptedJson);

                // Encrypt the symmetric key using RSA
                let encryptedSymmetricKey = encrypt.encrypt(
                    symmetricKey.toString()
                );
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
