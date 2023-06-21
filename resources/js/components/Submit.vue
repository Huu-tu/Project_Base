<template>
    <div class="submit-wrap">
        <select-option v-if="needConfirm === 1"></select-option>
        <Editor v-if="needFeedback === 1"></Editor>
        <button class="btn btn-primary" type="submit">Button</button>
    </div>
</template>

<script>
import SelectOption from "./SelectOption.vue";
import Editor from "./Editor.vue";

export default {
    name: "Submit",
    props: {
        needConfirm: null,
        needFeedback: null,
    },
    data() {
        return {
            feedback: "",
            type: "",
        };
    },
    components: {
        SelectOption,
        Editor,
    },
    methods: {
        // async onSubmit() {
        //     try {
        //         let isAuth = this.$route.query.param;
        //         let apiRequest = `${apiPath}/api/receiver-mail/store`;
        //         await axios.post(apiRequest, {
        //             user_mail: this.userEmail,
        //             mail_id: this.id,
        //             confirm: this.type,
        //             feedback: this.feedback,
        //         });
        //         // let vm = this;
        //         // let modal = this.$refs.modalAccepted;
        //         // modal.addEventListener("hide.bs.modal", function () {
        //         //     vm.onFetchData();
        //         // });
        //         // let bsModal = bootstrap.Modal.getInstance(modal);
        //         // bsModal.hide();
        //     } catch (err) {
        //         console.log(err);
        //     }
        // },
        // onFetchData() {
        //     this.$emit("onFetchData");
        // },
        // onBackClick() {
        //     this.$router.push("/list");
        // },
        // submitType(type) {
        //     this.type = type;
        // },
    },
};
</script>

<style></style>
