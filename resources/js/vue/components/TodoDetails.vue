<template>
    <h1>{{ todo.name }} - Időpont: {{ todo.due_date }}</h1>
    <task-list :tasklist="todo.sub_todos"></task-list>
</template>

<script>
import TaskList from "./TaskList";
export default {
    components: { TaskList },
    props: ["todo"],
};
</script>

<style></style>
