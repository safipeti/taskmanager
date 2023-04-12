<template>
    <div v-if="validationError" class="alert alert-danger" role="alert">
        A teendő nevének és leíásának megadása kötelező!
    </div>
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
        <div class="btn-controls">
            <button type="button" class="btn btn-primary" @click="submit">
                Mentés
            </button>
            <button type="button" class="btn btn-warning" @click="cancel">
                Elvetés
            </button>
            <button
                type="button"
                class="btn btn-danger"
                @click="deleteTask(todo.id)"
            >
                Törlés
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["todo"],
    data() {
        return {
            validationError: false,
        };
    },
    methods: {
        submit() {
            if (!this.todo.name || !this.todo.description) {
                this.validationError = true;
                setTimeout(() => {
                    this.validationError = false;
                }, 3000);
            } else {
                axios.put(`api/todos/${this.todo.id}`, {
                    name: this.todo.name,
                    description: this.todo.description,
                });
            }
        },

        deleteTask(id) {
            axios.post("api/deletetask", {
                id,
            });

            this.$emit("changeComponent", {
                todo: null,
                component: "todo-list",
            });
        },

        cancel() {
            this.$emit("changeComponent", {
                todo: null,
                component: "todo-list",
            });
        },
    },
};
</script>

<style>
.btn-controls {
    margin-top: 20px;
    display: flex;
    justify-content: space-evenly;
}
</style>
