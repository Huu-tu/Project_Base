<template>
    <div class="main-container">
        <div class="main-wrap">
            <div class="navigation-wrap">
                <div class="sample-text">Subject name: Lorem ipsum</div>
                <div class="sample-nav">
                    <div class="btn-back">
                        <a @click="onBackClick" v-if="!authFlag"> Quay lại </a>
                    </div>
                    <div class="btn-delete">
                        <a v-if="!authFlag"> Xóa </a>
                    </div>
                </div>
            </div>
            <div class="infomation-wrap">
                <div class="info-title">
                    {{ title }}
                </div>
                <div class="infomation-container">
                    <div class="info-wrap">
                        <img :src="avatar" />
                        <div class="info-name-mail-party">
                            <div class="info-name-mail">
                                <div class="info-name">{{ sender }}</div>
                                <div class="info-mail">&lt;{{ email }}&gt;</div>
                            </div>
                            <div class="info-party">
                                <span class="badge">{{ party }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="info-time">{{ createdAt }}</div>
                </div>
                <div class="mail-wrap">
                    {{ content }}
                </div>
            </div>
            <div class="discussion-wrap">
                <div class="wrap-text">Lorem ipsum</div>
                <div class="list-comment">
                    <Comment
                        v-for="comment in comments"
                        :key="comment.id"
                        :id="comment.id"
                        :content="comment.content"
                        :user="comment.name"
                        :userId="comment.user_id"
                        :postId="comment.post_id"
                        :createdAt="comment.created_at"
                    >
                    </Comment>
                </div>
                <div class="wrap-text">Your comment</div>
                <ckeditor
                    :editor="editor"
                    v-model="editorData"
                    :config="editorConfig"
                ></ckeditor>
                <button class="btn btn-primary btn-submit" @click="onSubmitComment">Đăng</button>
            </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Comment from "./Comment.vue";
import axios from "axios";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Discussion",
    data() {
        return {
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                language: "vi",
            },
            comments: [
                // {
                //     id: 2217,
                //     author: "George",
                //     body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                //     timestamp: "10/21/2022 12:14:19",
                // },
                // {
                //     id: 2216,
                //     author: "Stephanie",
                //     body: "Comment Two",
                //     timestamp: "10/23/2022 12:14:12",
                // },
            ],
        };
    },
    props: {
        id: Number,
        title: String,
        content: String,
        email: String,
        sender: String,
        status: Number,
        createdAt: String,
        party: String,
        avatar: String,
        authFlag: Boolean,
    },
    components: {
        Comment: Comment,
    },
    mounted() {
        this.fetchData()
    },
    methods: {
        onBackClick() {
            this.$router.push("/list");
        },
        async fetchData() {
            try {
                let apiRequest = `${apiPath}/permission/getComment/${this.id}`;
                let resRequest = (await axios.get(apiRequest)).data;
                console.log(resRequest)
                this.comments = resRequest
            } catch(e) {
                console.log(e)
            }
        },
        async onSubmitComment() {
            try {
                let infoUser = (await axios.get(`${apiPath}/info-user`)).data;
                console.log(
                    infoUser
                )
                let apiRequest = `${apiPath}/comment/store`
                let send = await axios.post(apiRequest, {
                    content: this.editorData,
                    name: infoUser.name,
                    user_id: infoUser.id,
                    post_id: this.id,
                })
                console.log(infoUser)
                this.fetchData();
            } catch (e) {
                console.log(e)
            }
        }
    },
};
</script>

<style></style>
