<template>
    <div class="row">
        <a class="user-avatar col-md-auto">
            <img src="../assets/images/avatar.png" />
        </a>

        <div class="user-discuss col-md-auto">
            <p class="user">
                <span>{{ user }} </span>
                <!-- <span class="badge">chức vụ</span> -->
                <span>{{ createdAt }}</span>
            </p>
            <p class="comment">
                {{ reply }}
            </p>
        </div>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    name: "ReplyComment",
    props: {
        id: Number,
        reply: String,
        user: String,
        commentId: Number,
        createdAt: String
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                language: "vi",
            },
        };
    },
};
</script>

<style></style>
