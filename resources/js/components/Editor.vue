<template>
    <div class="text-field-wrap">
        <ckeditor
            :editor="editor"
            v-model="editorData"
            :config="editorConfig"
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
};
</script>

<style></style>
