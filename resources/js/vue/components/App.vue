<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Title</div>

                    <div class="card-body">
                        <todo-list></todo-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TodoList from "./TodoList.vue";
export default {
    components: { TodoList },
};
</script>

<style></style>
