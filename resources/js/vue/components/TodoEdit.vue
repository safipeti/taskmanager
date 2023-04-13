<template>
    <h1 v-if="todo.id">Teendő módosítása</h1>
    <h1 v-else>Új teendő létrehozása</h1>
    <div v-if="validationError" class="alert alert-danger" role="alert">
        A teendő nevének és leíásának megadása kötelező!
    </div>
    <todo-form
        :todo="todo"
        @submit="submit"
        @cancel="cancel"
        @deleteTask="deleteTask"
    ></todo-form>
</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import TodoForm from "./TodoForm.vue";
export default {
    components: { VueDatePicker, TodoForm },
    props: ["todo"],
    data() {
        return {
            validationError: false,
            date: new Date(),
        };
    },
    methods: {
        submit(obj) {
            this.date = obj.date;
            if (!this.todo.name || !this.todo.description) {
                this.validationError = true;
                setTimeout(() => {
                    this.validationError = false;
                }, 3000);
            } else {
                const data = {
                    name: this.todo.name,
                    description: this.todo.description,
                };

                if (!this.todo.id) {
                    data["due_date"] = `${this.date.getFullYear()}-${(
                        this.date.getMonth() + 1
                    )
                        .toString()
                        .padStart(2, "0")}-${this.date
                        .getDate()
                        .toString()
                        .padStart(2, "0")}`;

                    axios.post(`api/todos`, data);
                } else {
                    axios.put(`api/todos/${this.todo.id}`, data);
                }

                console.log(this.todo);

                this.$emit("changeComponent", {
                    todo: null,
                    component: "todo-list",
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
                todo: this.todo.id ? this.todo : null,
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
