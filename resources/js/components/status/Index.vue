<template>
    <div class="container">
        <div class="col-12">
            <div class="alert" v-if="statuses.length === 0">
                <div class="alert alert-danger">No Data Yet</div>
                <button
                            class="btn btn-primary btn-xl mt-2 mb-3 float-right"
                            data-bs-target="#createStatusModal"
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
                            Create a new Task Status
                        </button>
            </div>
            <div class="card" style="width: 100%" v-if="statuses.length !== 0">
                <div class="card-title text-center">
                    <h1 class="mt-4">Statuses</h1>
                </div>
                <div class="card-body">
                    <div class="tables mt-8" >
                        <button
                            class="btn btn-primary btn-xl mt-2 mb-3 float-right"
                            data-bs-target="#createStatusModal"
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
                            Create a new Task Status
                        </button>
                        <table
                            class="table table-bordered table-responsive table-hover table-striped text-center"
                        >
                            <thead>
                                <tr>
                                    <th class="col">ID</th>
                                    <th class="col">Name</th>
                                    <th class="col">Created At</th>
                                    <th class="col">Updated At</th>
                                    <th class="col">EDIT</th>
                                    <th class="col">DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(status, index) in statuses"
                                    :key="index"
                                >
                                    <td>{{ status.id }}</td>
                                    <td>
                                        {{ status.name }}
                                    </td>
                                    <td>
                                        {{ status.created_at }}
                                    </td>
                                    <td>
                                        {{ status.updated_at }}
                                    </td>
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
                                                @click="deleteStatus(status.id)"
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

            <!-- create Status Modal -->
            <div
                class="modal fade"
                id="createStatusModal"
                tabindex="-1"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createStatusLabel">
                                Create a New Status
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <form @submit.prevent="createNewStatus" class="form">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="taskName" class="form-label"
                                        >Task Name</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="task_name"
                                        placeholder="e.g Bug Fixing"
                                        v-model="status.name"
                                    />
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
                                    Save changes
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


const statusStore = useStatuses();

export default {
    data() {
        return {
            // statuses: [],
            status: {
                name: ''
            }
        }
    },
    computed: {
        ...mapState(useStatuses, {
            statuses: 'statuses'
        })
    },

    mounted() {
        this.getAllStatuses();
    },
    methods: {
        ...mapActions(useStatuses, {
            getAllStatuses: 'fetchAllStatuses'
        }),
        async createNewStatus() {
            await statusStore.createNewStatus(this.status);
        },
        async deleteStatus(id) {
            await statusStore.deleteStatus(id);
        }
    },
}
</script>
