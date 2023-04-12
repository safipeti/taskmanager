<template>
    <ul class="list-group" v-if="tasklist">
        <li
            v-for="task in tasklist"
            :key="task.id"
            class="list-group-item d-flex justify-content-between align-items-center"
            :class="{ done: task.done }"
        >
            {{ task.name }}

            <button
                v-if="!task.done"
                type="button"
                class="btn btn-secondary"
                @click="setDone(task.id)"
            >
                Elkészült
            </button>
            <button v-if="!task.done" type="button" class="btn btn-warning">
                Módosítás
            </button>
            <button
                type="button"
                class="btn btn-danger"
                @click="deleteTask(task.id)"
            >
                Törlés
            </button>
        </li>
    </ul>
</template>

<script>
export default {
    name: "TaskList",
    props: ["tasklist"],
    emits: ["changeComponent"],
    methods: {
        setDone(id) {
            axios.post("api/settaskdone", {
                id,
            });

            this.setUi(id);
        },

        setUi(id) {
            this.tasklist.forEach((element) => {
                if (element["id"] == id) {
                    element["done"] = true;
                }
            });
        },

        removeFromUi(id) {
            this.tasklist.forEach((element) => {
                if (element["id"] == id) {
                    this.tasklist.splice(element, 1);
                }
            });
        },

        deleteTask(id) {
            axios.post("api/deletetask", {
                id,
            });

            this.removeFromUi(id);
        },
    },
};
</script>

<style>
.done {
    background: #17a2b8;
}
</style>
