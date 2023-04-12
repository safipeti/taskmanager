<template>
    <date-picker @dateChanged="getTodos"></date-picker>
    <ul class="list-group">
        <li
            v-for="todo in todos"
            :key="todo.id"
            class="list-group-item d-flex justify-content-between align-items-center"
        >
            {{ todo.name }}
            <span class="badge badge-primary badge-pill">1004</span>
            <button
                type="button"
                class="btn btn-primary"
                @click="
                    $emit('changeComponent', {
                        todo: todo,
                        component: 'todo-details',
                    })
                "
            >
                Feladatok
            </button>
            <button type="button" class="btn btn-warning">Módosítás</button>
        </li>
    </ul>
</template>

<script>
import DatePicker from "./DatePicker.vue";
export default {
    name: "TodoList",
    components: { DatePicker },
    emits: ["changeComponent"],
    data() {
        return {
            todos: {},
        };
    },

    methods: {
        getTodos(date) {
            let due_date;

            if (date) {
                due_date = `${date.getFullYear()}-${(date.getMonth() + 1)
                    .toString()
                    .padStart(2, "0")}-${date
                    .getDate()
                    .toString()
                    .padStart(2, "0")}`;
                axios.get(`api/todos?due_date=${due_date}`).then((resp) => {
                    this.todos = resp.data;
                });
            } else {
                axios.get(`api/todos`).then((resp) => {
                    this.todos = resp.data;
                });
            }
        },
    },

    created() {
        this.getTodos();
    },
};
</script>

<style></style>
