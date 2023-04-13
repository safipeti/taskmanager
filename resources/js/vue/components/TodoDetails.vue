<template>
    <div class="flexbox">
        <h3>{{ todo.name }} - Időpont: {{ todo.due_date }}</h3>
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
    </div>
    <h4 v-if="todo.sub_todos.length">
        Feladatok: {{ todo.sub_todos.length }} | Aktív: {{ activeTasks }} |
        Kész: {{ doneTasks }}
    </h4>
    <h4 v-else>Nincs feladat</h4>
    <div v-if="validationError" class="alert alert-danger" role="alert">
        A feladat nevének és leíásának megadása kötelező!
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Feladat neve</label>
        <input
            type="text"
            class="form-control"
            id="name"
            placeholder=""
            v-model="taskName"
        />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Feladat leíása</label>
        <textarea
            class="form-control"
            id="description"
            rows="3"
            v-model="taskDescription"
        ></textarea>

        <div class="btn-controls">
            <button type="button" class="btn btn-primary" @click="addTask">
                Mentés
            </button>
        </div>
    </div>

    <task-list @loadTask="loadTask" :tasklist="todo.sub_todos"></task-list>
</template>

<script>
import TaskList from "./TaskList";
import TodoForm from "./TodoForm.vue";

export default {
    data() {
        return {
            taskId: null,
            taskName: "",
            taskDescription: "",
            validationError: false,
        };
    },

    components: { TaskList, TodoForm },
    props: ["todo"],

    methods: {
        addTask() {
            if (this.taskName == "" || this.taskDescription == "") {
                this.validationError = true;
                setTimeout(() => {
                    this.validationError = false;
                }, 3000);
            } else {
                const task = {
                    name: this.taskName,
                    description: this.taskDescription,
                };
                if (!this.taskId) {
                    task["parent_id"] = this.todo.id;
                    axios.post(`api/todos`, task).then((x) => {
                        this.todo.sub_todos.push({
                            id: x.data.id,
                            parent_id: this.todo.id,
                            name: this.taskName,
                            description: this.taskDescription,
                        });
                        this.taskName = "";
                        this.taskDescription = "";
                    });
                } else {
                    axios.put(`api/todos/${this.taskId}`, task).then(() => {
                        this.todo.sub_todos.forEach((element) => {
                            if (element["id"] == this.taskId) {
                                console.log(element["id"], "-", this.taskId);
                                element["name"] = this.taskName;
                                element["description"] = this.taskDescription;
                            }
                        });

                        this.taskName = "";
                        this.taskDescription = "";
                    });
                }
            }
        },

        loadTask(task) {
            this.taskId = task.id;
            this.taskName = task.name;
            this.taskDescription = task.description;
        },
    },

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

<style>
.flexbox {
    display: flex;
    justify-content: space-between;
}
</style>
