<template>
    <h3>{{ todo.name }} - Időpont: {{ todo.due_date }}</h3>
    <h4 v-if="todo.sub_todos.length">
        Feladatok: {{ todo.sub_todos.length }} | Aktív: {{ activeTasks }} |
        Kész: {{ doneTasks }}
    </h4>
    <h4 v-else>Nincs feladat</h4>
    <task-list :tasklist="todo.sub_todos"></task-list>
    <button
        type="button"
        class="btn btn-warning"
        @click="
            $emit('changeComponent', {
                todo: null,
                component: 'todo-list',
            })
        "
    >
        Vissza
    </button>
</template>

<script>
import TaskList from "./TaskList";
export default {
    components: { TaskList },
    props: ["todo"],

    computed: {
        activeTasks() {
            return this.todo.sub_todos.filter((x) => !x.done).length;
        },
        doneTasks() {
            return this.todo.sub_todos.filter((x) => x.done).length;
        },
    },
};
</script>

<style></style>
