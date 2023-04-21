<template>
    <div class="container">
        <div class="col-12">
            <div class="alert" v-if="!userTasks">
                <div class="alert alert-danger">No Data Yet</div>
                <button
                            class="btn btn-primary btn-xl mt-2 mb-3 float-right"
                            data-bs-target="#createUserTaskModal"
                            data-bs-toggle="modal"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-plus-circle-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"
                                />
                            </svg>
                            Create a new User Task
                        </button>
            </div>
            <div class="card" style="width: 100%" v-else>
                <div class="card-title text-center">
                    <h1 class="mt-4">User Tasks</h1>
                </div>
                <div class="card-body">
                    <div class="tables mt-8">
                        <button
                            class="btn btn-primary btn-xl mt-2 mb-3 float-right"
                            data-bs-target="#createUserTaskModal"
                            data-bs-toggle="modal"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-plus-circle-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"
                                />
                            </svg>
                            Create a new User Task
                        </button>
                        <table
                            class="table table-bordered table-responsive table-hover table-striped text-center"
                        >
                            <thead>
                                <tr>
                                    <th class="col">ID</th>
                                    <th class="col">User ID</th>
                                    <th class="col">Task ID</th>
                                    <th class="col">Status ID</th>
                                    <th class="col">Due Date</th>
                                    <th class="col">Start TIme</th>
                                    <th class="col">End Time</th>
                                    <th class="col">Remarks</th>
                                    <th class="col">EDIT</th>
                                    <th class="col">DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(userTask, index) in userTasks"
                                    :key="index"
                                >
                                    <td>{{ userTask.id }}</td>
                                    <td>{{ userTask.user_id }}</td>
                                    <td>{{ userTask.task_id }}</td>
                                    <td>{{ userTask.status_id }}</td>
                                    <td>{{ userTask.due_date }}</td>
                                    <td>{{ userTask.start_time }}</td>
                                    <td>{{ userTask.end_time }}</td>
                                    <td>{{ userTask.remarks }}</td>


                                    <td>
                                        <button
                                            class="btn btn-secondary btn-sm"
                                            type="button"
                                            data-bs-target="#createStatusModal"
                                            data-bs-toggle="modal"
                                        >
                                            EDIT
                                        </button>
                                    </td>
                                    <td>
                                        <form>
                                            <button
                                                class="btn btn-danger btn-sm"
                                                type="button"
                                                @click="deleteTask(task.id)"
                                            >
                                                DELETE
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- create Task Modal -->
            <div
                class="modal fade"
                id="createUserTaskModal"
                tabindex="-1"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createStatusLabel">
                                Create a New User Task
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <form class="form" @submit.prevent="createNewUserTask">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="userTaskUserId" class="form-label"
                                        >User ID</label
                                    >
                                    <select
                                        class="form-select"
                                        name="user_Id"
                                        id="userId"
                                        v-model="userTask.user_id"
                                    >
                                        <option
                                            v-for="(user, index) in users"
                                            :key="index"
                                            :value="user.id"
                                        >
                                            {{ user.email }}
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="userTaskUserId" class="form-label"
                                        >Task ID</label
                                    >
                                    <select
                                        class="form-select"
                                        name="userTask_taskId"
                                        id="userTask_taskId"
                                        v-model="userTask.task_id"
                                    >
                                        <option
                                            v-for="(task, index) in tasks"
                                            :key="index"
                                            :value="task.id"
                                        >
                                            {{ task.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label
                                        for="userTaskRemarks"
                                        class="form-label"
                                        >Remarks</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="task_description"
                                        placeholder="e.g No Comment"
                                        v-model="userTask.remarks"
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="userTaskDueDate" class="form-label"
                                        >Due Date</label
                                    >
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="userTask_dueDate"
                                        v-model="userTask.due_date"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="userTaskStartTIme" class="form-label"
                                        >Start Time</label
                                    >
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="userTask_startTIme"
                                        v-model="userTask.start_time"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label for="userTaskEndTIme" class="form-label"
                                        >End Time</label
                                    >
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="userTask_endTIme"
                                        v-model="userTask.end_time"
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="usertaskStatusId" class="form-label"
                                        >Status ID</label
                                    >
                                    <select
                                        class="form-select"
                                        name="userTask_statusId"
                                        id="userTask_statusId"
                                        v-model="userTask.status_id"
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
                            </div>

                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-success"
                                    data-bs-dismiss="modal"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
import { mapState, mapActions } from 'pinia';
import {useStatuses} from '../../store/status/index';
import {useTasks} from '../../store/task/index';
import { useUserTasks } from '../../store/userTask';
import { useUsers } from '../../store/users';


const statusStore = useStatuses();
const tasksStore = useTasks();
const userTasksStore = useUserTasks();

export default {
    data() {
        return {
            userTask: {
                user_id: '',
                task_id: '',
                status_id: '',
                due_date: '',
                start_time: '',
                end_time: '',
                remarks: ''
            }
        }
    },
    computed: {
        ...mapState(useStatuses, {
            statuses: 'statuses'
        }),
        ...mapState(useTasks, {
            tasks: 'allTasks'
        }),

        ...mapState(useUserTasks, {
            userTasks: 'allUSerTasks'
        }),

        ...mapState(useUsers, {
            users: 'allUsers'
        })
    },

    mounted() {
        this.getAllUserTasks();
    //    this.getAllTasks();
    //    this.getAllStatuses();
    },
    methods: {
        ...mapActions(useStatuses, {
            getAllStatuses: 'fetchAllStatuses'
        }),

        ...mapActions(useTasks, {
            getAllTasks: 'fetchAllTasks'
        }),

        ...mapActions(useUserTasks, {
            getAllUserTasks: 'fetchAllUserTasks'
        }),

        async createNewUserTask() {
            // console.log(this.userTask);
            await userTasksStore.createNewUserTask(this.userTask)
        },
        async deleteUserTask(id) {
            await userTasksStore.deleteUserTask(id);

        },

    },
}
</script>
