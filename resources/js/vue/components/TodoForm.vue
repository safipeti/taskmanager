<template>
    <div class="mb-3">
        <label for="name" class="form-label">Teendő neve</label>
        <input
            type="email"
            class="form-control"
            id="name"
            placeholder=""
            v-model="todo.name"
        />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Teendő leíása</label>
        <textarea
            class="form-control"
            id="description"
            rows="3"
            v-model="todo.description"
        ></textarea>
        <div v-if="!todo.id">
            <label for="description" class="form-label">Teendő napja</label>
            <vue-date-picker
                v-model="date"
                format="yyy-MM-dd"
                show-now-button
            ></vue-date-picker>
        </div>

        <div class="btn-controls">
            <button
                type="button"
                class="btn btn-primary"
                @click="$emit('submit', { todo, date })"
            >
                Mentés
            </button>
            <button
                type="button"
                class="btn btn-warning"
                @click="$emit('cancel')"
            >
                Elvetés
            </button>
            <button
                v-if="todo.id"
                type="button"
                class="btn btn-danger"
                @click="$emit('deleteTask', todo.id)"
            >
                Törlés
            </button>
        </div>
    </div>
</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
export default {
    components: { VueDatePicker },
    props: ["todo"],
    emits: ["submit", "cancel", "deleteTask"],
    data() {
        return {
            date: new Date(),
        };
    },
};
</script>

<style></style>
