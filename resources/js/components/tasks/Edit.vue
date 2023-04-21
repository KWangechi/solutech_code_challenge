<template>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow md mt-5">
                    <div class="card-body">
                        <h3 class="text-center">Edit Task - {{ task.name }}</h3>
                        <hr />
                        <form
                            class="row"
                            method="post"
                            @submit.prevent="updateTask(task)"
                        >
                            <div class="col-12">
                                <div class="alert alert-danger" v-if="errors">
                                    {{ errors }}
                                    <ul class="mb-0"></ul>
                                </div>
                            </div>

                            <div class="form-group col-12 my-2 mt-3">
                                <label for="email" class="font-weight-bold"
                                    >Task Name</label
                                >
                                <input
                                    type="text"
                                    name="task_name"
                                    v-model="task.name"
                                    id="task_name"
                                    class="form-control mt-3"
                                />
                            </div>

                            <div class="form-group col-12 my-2 mt-3">
                                <label for="email" class="font-weight-bold"
                                    >Task Description</label
                                >
                                <input
                                    type="text"
                                    name="task_description"
                                    v-model="task.description"
                                    id="task_descrption"
                                    class="form-control mt-3"
                                />
                            </div>

                            <div class="form-group col-12 my-2 mt-3">
                                <label for="email" class="font-weight-bold"
                                    >Due Date</label
                                >
                                <input
                                    type="date"
                                    name="task_dueDate"
                                    v-model="task.due_date"
                                    id="task_dueDate"
                                    class="form-control mt-3"
                                />
                            </div>

                            <div class="mb-3">
                                <label for="taskStatusId" class="form-label"
                                    >Status Name</label
                                >
                                <select
                                    class="form-select"
                                    name="statusId"
                                    id="statusId"
                                    v-model="task.status_id"
                                >
                                    <option
                                        v-for="(status, index) in statuses"
                                        :key="index"
                                        :value="status.id"
                                    >
                                        {{ status.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="row mb-2 mt-4">
                                <div class="col-sm-5 col-md-6">
                                    <router-link :to="{ name: 'tasks' }">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                        >
                                            Back
                                        </button>
                                    </router-link>
                                </div>
                                <div
                                    class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"
                                >
                                    <button
                                        type="submit"
                                        class="btn btn-success"
                                    >
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState, mapActions } from "pinia";
import { useStatuses } from "../../store/status/index";
import {useTasks} from '../../store/task/index'


// const statusStore = useStatuses();
const tasksStore = useTasks()

export default {
    data() {
        return {
            task: "",
        };
    },
    computed: {
        ...mapState(useTasks, {
            errors: "getErrors",
        }),
        ...mapState(useStatuses, {
            statuses: 'statuses'
        }),

    },

    mounted() {
        this.getLoadedStatus();
    },
    methods: {
        getLoadedStatus() {
            this.status = statusStore.getStatus;

            console.log(statusStore.getStatus);
            return statusStore.getStatus;
        },
        async updateStatus(updated_status) {
            await statusStore.updateStatus(updated_status);
        },
    },
};
</script>
