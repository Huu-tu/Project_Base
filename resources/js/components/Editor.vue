<template>
    <div class="editor-wrap">
        <p>My reaction to that infomation:</p>
        <ckeditor
            :editor="editor"
            v-model="editorData"
            :config="editorConfig"
            @input="emitFeedback"
        ></ckeditor>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const apiPath = process.env.MIX_API_PATH;

export default {
    name: "Editor",
    data() {
        return {
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                language: "vi",
            },
        };
    },
    methods: {
        emitFeedback() {
            const content = this.extractContent();
            this.$emit("feedback", content)
        },
        extractContent() {
            const div = document.createElement("div");
            div.innerHTML = this.editorData;
            return div.textContent || div.innerText || "";
        },
    }
};
</script>

<style></style>
