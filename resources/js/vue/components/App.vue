<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1><a href="">Feladatkezelő</a></h1>
                    </div>

                    <div class="card-body">
                        <component
                            :todo="todo"
                            :is="currentComponent"
                            @changeComponent="changeComponent"
                        ></component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TodoList from "./TodoList.vue";
import TodoDetails from "./TodoDetails.vue";

export default {
    components: { TodoList, TodoDetails },
    data() {
        return {
            currentComponent: "todo-list",
            todo: null,
        };
    },

    methods: {
        changeComponent(data) {
            data = JSON.parse(JSON.stringify(data));
            console.log(data.todo);
            this.currentComponent = data.component;
            this.todo = data.todo;
        },
    },
};
</script>

<style></style>
