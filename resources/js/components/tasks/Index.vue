<template>
  <div class="container">
    <div class="col-12">
      <div class="alert" v-if="!tasks">
        <div class="alert alert-danger">No Data Yet</div>
        <button
          class="btn btn-primary btn-xl mt-2 mb-3 float-right"
          data-bs-target="#createTaskModal"
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
          Create a new Task
        </button>
      </div>
      <div class="card" style="width: 100%" v-else>
        <div class="card-title text-center">
          <h1 class="mt-4">Tasks</h1>
        </div>
        <div class="card-body">
          <div class="tables mt-8">
            <button
              class="btn btn-primary btn-xl mt-2 mb-3 float-right"
              data-bs-target="#createTaskModal"
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
              Create a new Task
            </button>
            <table
              class="table table-bordered table-responsive table-hover table-striped text-center"
            >
              <thead>
                <tr>
                  <th class="col">ID</th>
                  <th class="col">Name</th>
                  <th class="col">Description</th>
                  <th class="col">Due Date</th>
                  <th class="col">Status ID</th>
                  <th class="col">EDIT</th>
                  <th class="col">DELETE</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(task, index) in tasks" :key="index">
                  <td>{{ task.id }}</td>
                  <td>{{ task.name }}</td>
                  <td>{{ task.description }}</td>
                  <td>{{ task.due_date }}</td>
                  <td>{{ task.status_id }}</td>

                  <td>
                    <button
                      class="btn btn-secondary btn-sm"
                      type="button"
                      @click.prevent="editTask(task)"
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
      <div class="modal fade" id="createTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createStatusLabel">Create a New Task</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form class="form" @submit.prevent="createNewTask">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="taskName" class="form-label">Task Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="task_name"
                    placeholder="e.g Bug Fixing"
                    v-model="task.name"
                  />
                </div>

                <div class="mb-3">
                  <label for="taskDescription" class="form-label">Description</label>
                  <input
                    type="text"
                    class="form-control"
                    id="task_description"
                    placeholder="e.g a major bug in the Create User Module"
                    v-model="task.description"
                  />
                </div>

                <div class="mb-3">
                  <label for="taskDueDate" class="form-label">Due Date</label>
                  <input
                    type="date"
                    class="form-control"
                    id="task_dueDate"
                    v-model="task.due_date"
                  />
                </div>
                <div class="mb-3">
                  <label for="taskStatusId" class="form-label">Status ID</label>
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
import {useTasks} from '../../store/task/index'

const tasksStore = useTasks()

export default {
    data() {
        return {
            task: {
                name: '',
                description: '',
                due_date: '',
                status_id: ''
            }
        }
    },
    computed: {
        ...mapState(useStatuses, {
            statuses: 'statuses'
        }),
        ...mapState(useTasks, {
            tasks: 'allTasks'
        })
    },

    mounted() {
       this.getAllTasks();
    },
    methods: {
        ...mapActions(useStatuses, {
            getAllStatuses: 'fetchAllStatuses'
        }),

        ...mapActions(useTasks, {
            getAllTasks: 'fetchAllTasks'
        }),

        async createNewTask() {
            await tasksStore.createNewTask(this.task);
        },
        async editTask(task) {
            await tasksStore.editTask(task);
        },

        async updateTask(updated_task) {
            console.log(updated_task);
        },

        async deleteTask(id) {
            await tasksStore.deleteTask(id);
        }
    },
}
</script>
