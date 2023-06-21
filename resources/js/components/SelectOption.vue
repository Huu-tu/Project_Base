<template>
    <div class="select-wrap">
        <!-- <p>Select one:</p> -->
        <div class="wrapper">
            <input
                class="form-check-input"
                type="radio"
                name="radioSelect"
                id="radioConfirm"
                value="1"
                v-model="optionSelected"
                @change="emitSelection"
            />
            <label class="option optionConfirm" for="radioConfirm">
                <div class="dot"></div>
                <span>Confirm</span>
            </label>
            <input
                class="form-check-input"
                type="radio"
                name="radioSelect"
                id="radioReject"
                value="0"
                v-model="optionSelected"
                @change="emitSelection"
            />
            <label class="option optionReject" for="radioReject">
                <div class="dot"></div>
                <span>Reject</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: "SelectButton",
    data() {
        return {
            optionSelected: "",
        }
    },
    methods: {
        emitSelection() {
            this.$emit("option-selected", this.optionSelected)
        }
    }
};
</script>

<style></style>
