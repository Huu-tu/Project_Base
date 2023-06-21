<template>
    <div class="row">
        <a class="user-avatar col-md-auto">
            <img src="../assets/images/PNG/avatar.png" />
        </a>

        <div class="user-discuss col-md-auto">
            <p class="user">
                <span>{{ user }} </span>
                <!-- <span class="badge">chức vụ</span> -->
                <span>{{ createdAt }}</span>
            </p>
            <div class="comment">
                <span v-html="content"></span>
                <div class="add-comment">
                    <a @click="openReply">Add a comment</a>
                </div>
            </div>
        </div>

        <div class="user-reply col-md-12" v-if="hasComment">
            <a @click="openComment" v-if="!isComment" class="toggle-reply">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="1em"
                    viewBox="0 0 512 512"
                    fill="#394867"
                >
                    <path
                        d="M307 477.2c-11.5-5.1-19-16.6-19-29.2v-64H176C78.8 384 0 305.2 0 208C0 94.7 81.5 44.1 100.2 33.9c2.5-1.4 5.3-1.9 8.1-1.9c10.9 0 19.7 8.9 19.7 19.7c0 7.5-4.3 14.4-9.8 19.5C108.8 80.1 96 97.6 96 128c0 53 43 96 96 96h96v-64c0-12.6 7.4-24.1 19-29.2s25-3 34.4 5.4l160 144c6.7 6.1 10.6 14.7 10.6 23.8s-3.8 17.7-10.6 23.8l-160 144c-9.4 8.5-22.9 10.6-34.4 5.4z"
                    />
                </svg>
                Xem tất cả {{ numberOfReplies }} phản hồi
            </a>
            <a @click="openComment" v-if="isComment" class="toggle-reply">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="1em"
                    viewBox="0 0 384 512"
                    fill="#394867"
                >
                    <path
                        d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
                    />
                </svg>
                Ẩn tất cả phản hồi
            </a>

            <div v-if="replies.length && isComment" class="comment-replies">
                <reply-comment
                    v-for="reply in replies"
                    :key="reply.id"
                    v-bind="reply"
                    :id="reply.id"
                    :reply="reply.reply"
                    :user="reply.name"
                    :commentId="reply.commentId"
                    :createdAt="convertDateTime(reply.created_at)"
                />
            </div>
        </div>

        <div class="editor-area" v-if="isAddComment">
            <ckeditor
                :editor="editor"
                v-model="editorData"
                :config="editorConfig"
            ></ckeditor>
            <button class="btn btn-primary btn-submit" @click="getComment">
                Đăng
            </button>
        </div>
    </div>
</template>

<script>
import ReplyComment from "./ReplyComment.vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import axios from "axios";
import { convertDate } from "../convert.js";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Comment",
    props: {
        id: Number,
        content: String,
        user: String,
        userId: Number,
        postId: Number,
        createdAt: String,
    },
    components: {
        ReplyComment: ReplyComment,
    },
    data() {
        return {
            isComment: false,
            isAddComment: false,
            editor: ClassicEditor,

            editorData: "",
            editorConfig: {
                language: "vi",
            },
            replies: [
                // {
                //     id: 2217,
                //     author: "George",
                //     body: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                //     timestamp: "10/21/2022 12:14:19",
                // },
                // {
                //     id: 2216,
                //     author: "Stephanie",
                //     body: "Reply Two",
                //     timestamp: "10/23/2022 12:14:12",
                // },
            ],
        };
    },
    computed: {
        numberOfReplies() {
            return this.replies.length;
        },
        hasComment() {
            return this.numberOfReplies > 0 ? true : false;
        },
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        openComment() {
            this.isComment = !this.isComment;
        },
        openReply() {
            this.isAddComment = !this.isAddComment;
        },
        async fetchData() {
            try {
                let apiRequest = `${apiPath}/comments/get-reply/${this.id}`;
                let resRequest = (await axios.get(apiRequest)).data;
                console.log(resRequest);
                this.replies = resRequest;
            } catch (e) {
                console.log(e);
            }
        },
        getComment() {
            console.log(this.editorData);
        },
        convertDateTime(date) {
            return convertDate(date);
        },
    },
};
</script>

<style></style>
