<template>
    <div class="select-wrap">
        <p>Select one:</p>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="radioSelect"
                id="radioConfirm"
                value= 1
                v-model="optionSelected"
                @change="emitSelection"
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
                value=0
                v-model="optionSelected"
                @change="emitSelection"
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
