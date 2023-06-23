<template>
    <div class="spinner-wrap" v-if="loadSpinner">
        <div class="overlay"></div>
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Spinner",
    props: {
        loadSpinner: Boolean,
    },
};
</script>

<style></style>
