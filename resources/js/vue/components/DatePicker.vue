<template>
    <div class="dp-container">
        <button type="button" class="btn btn-primary" v-on:click="minusOneDay">
            back
        </button>
        <vue-date-picker
            v-model="date"
            format="Y-mm-dd"
            show-now-button
        ></vue-date-picker>
        <button type="button" class="btn btn-primary" v-on:click="addOneDay">
            forward
        </button>
    </div>
</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
export default {
    components: { VueDatePicker },
    data() {
        return {
            date: new Date(),
        };
    },

    methods: {
        addOneDay() {
            this.date = new Date(this.date.setDate(this.date.getDate() + 1));
        },
        minusOneDay() {
            this.date = new Date(this.date.setDate(this.date.getDate() - 1));
        },
    },
};
</script>

<style>
.dp-container {
    display: flex;
}
</style>
