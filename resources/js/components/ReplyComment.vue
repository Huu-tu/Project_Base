<template>
    <div class="row">
        <a class="user-avatar col-md-auto">
            <img src="../assets/images/avatar.png" />
        </a>

        <div class="user-discuss col-md-auto">
            <p class="user">
                <span>{{ author }} </span>
                <span class="badge">chức vụ</span>
                <span>{{ timestamp }}</span>
            </p>
            <p class="comment">
                {{ body }}
            </p>
        </div>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    name: "ReplyComment",
    props: {
        author: { type: String, required: true },
        body: { type: String, required: true },
        timestamp: { type: String, required: true },
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
