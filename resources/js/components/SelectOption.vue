<template>
    <div class="select-wrap">
        <p>Select one:</p>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="radioSelect"
                id="radioConfirm"
            />
            <label class="form-check-label" for="radioConfirm">
                Confirm
            </label>
        </div>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="radioSelect"
                id="radioReject"
            />
            <label class="form-check-label" for="radioReject">
                Reject
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: "SelectButton",
};
</script>

<style></style>
