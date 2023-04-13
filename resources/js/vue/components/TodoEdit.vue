<template>
    <h1 v-if="todo.id">Teendő módosítása</h1>
    <h1 v-else>Új teendő létrehozása</h1>
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
        <div v-if="!todo.id">
            <label for="description" class="form-label">Teendő napja</label>
            <vue-date-picker
                v-model="date"
                format="yyy-MM-dd"
                show-now-button
            ></vue-date-picker>
        </div>

        <div class="btn-controls">
            <button type="button" class="btn btn-primary" @click="submit">
                Mentés
            </button>
            <button type="button" class="btn btn-warning" @click="cancel">
                Elvetés
            </button>
            <button
                v-if="todo.id"
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
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
export default {
    components: { VueDatePicker },
    props: ["todo"],
    data() {
        return {
            validationError: false,
            date: new Date(),
            updated: null,
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

                    axios.post(`api/todos`, data).then((data) => {
                        this.updated = JSON.parse(JSON.stringify(data));
                    });
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
