import axios from "axios";
import { defineStore } from "pinia";
import Swal from "sweetalert2/dist/sweetalert2.js";
import router from "../../router";
import "vue3-toastify/dist/index.css";
import { toast } from "vue3-toastify";

export const useTasks = defineStore("tasks-store", {
    state: () => {
        return {
            tasks: [],
            task: "",
            errors: "",
        };
    },

    getters: {
        allTasks(state) {
            return state.tasks;
        },

        getErrors(state) {
            return state.errors;
        },
        getTask(state) {
            return state.task;
        },
    },

    actions: {
        async fetchAllTasks() {
            await axios.get("/sanctum/csrf-cookie");
            const response = await axios.get("/api/v1/tasks");
            try {
                this.tasks = response.data.data;
                return this.tasks;
            } catch (err) {
                this.tasks = [];
                console.error("Error fetching tasks:", err);
                return err;
            }
        },

        async createNewTask(task) {
            await axios.get("/sanctum/csrf-cookie");
            const res = await axios.post("/api/v1/tasks", task, {});


            if (res.data.status) {
                toast.success(res.data.message, {
                    position: "top-center",
                    pauseOnHover: false
                });

                this.task = res.data.data;
                this.tasks.push(this.task);

                console.log(this.tasks);
                router.push("/tasks");
            } else {
                toast.error(res.data.message, {});
                this.errors = res.data.message;
            }
        },

        async editTask(task) {
            await axios.get("/sanctum/csrf-cookie");

            const response = await axios.get(`/api/v1/task/${task.id}`, {});
            if (response.data.status) {
                this.task = response.data.data;

                console.log(this.task);
                router.push(`/task/edit/${this.task.id}`);

            } else {
                console.log(response.data.message);
                toast.error(response.data.message);

                this.errors = response.data.message;
            }
        },

        async updateTask(task) {
            await axios.get("/sanctum/csrf-cookie");

            const response = await axios.patch(
                `/api/v1/status/${task.id}`,
                task,
                {}
            );

            if (!response.data.status) {
                toast.error(response.data.message, {});
                this.errors = response.data.message;

            } else {
                toast.success(response.data.message, {
                    pauseOnHover: false
                });

                router.push(`/tasks`);

            }
        },


        async deleteTask(id) {
            await axios.get("/sanctum/csrf-cookie");

            Swal.fire({
                title: 'Task Deletion',
                text: 'Are you sure you want to delete this?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if(result.isConfirmed) {

                    axios.delete(`/api/v1/tasks/${id}`).then((response) => {

                        console.log(response.data);

                        if(!response.data.status) {
                            toast.error(response.data.message, {
                                position: 'top-center'
                            });
                        }

                        else {
                            toast.success(response.data.message, {
                                position: 'top-center',
                                pauseOnHover: false

                            });
                        }
                    })

                }

                this.fetchAllTasks();
              })

        },

        getLoggedInUser() {
            return this.user;
        },
    },
});

