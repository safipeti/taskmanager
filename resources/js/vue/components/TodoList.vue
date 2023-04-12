<template>
    <date-picker></date-picker>
    <ul class="list-group">
        <li
            v-for="todo in todos"
            :key="todo.id"
            class="list-group-item d-flex justify-content-between align-items-center"
        >
            {{ todo.name }}
            <span class="badge badge-primary badge-pill">1004</span>
            <button type="button" class="btn btn-primary">Feladatok</button>
            <button type="button" class="btn btn-warning">Módosítás</button>
        </li>
    </ul>
</template>

<script>
import DatePicker from "./DatePicker.vue";
export default {
    name: "TodoList",
    components: { DatePicker },
    data() {
        return {
            todos: {},
        };
    },

    methods: {
        getTodos() {
            axios.get("api/todos").then((resp) => {
                this.todos = resp.data;
            });
        },
    },

    created() {
        this.getTodos();
    },
};
</script>

<style></style>
