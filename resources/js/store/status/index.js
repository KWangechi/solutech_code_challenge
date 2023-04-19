import axios from "axios";
import { defineStore } from "pinia";
import Swal from "sweetalert2/dist/sweetalert2.js";
import router from "../../router";
import "vue3-toastify/dist/index.css";
import { toast } from "vue3-toastify";

export const useStatuses = defineStore("status-store", {
    state: () => {
        return {
            statuses: [],
            status: "",
            errors: "",
        };
    },

    getters: {
        allStatuses(state) {
            return state.statuses;
        },

        getErrors(state) {
            return state.errors;
        },
        getStatus(state) {
            return state.status;
        },
    },

    actions: {
        async fetchAllStatuses() {
            await axios.get("/sanctum/csrf-cookie");
            const response = await axios.get("/api/v1/status");
            try {
                this.statuses = response.data.data;
                return this.statuses;
            } catch (err) {
                this.statuses = [];
                console.error("Error fetching users:", err);
                return err;
            }
        },

        async createNewStatus(status) {
            await axios.get("/sanctum/csrf-cookie");
            const res = await axios.post("/api/v1/status", status, {});

            // use a toast message to
            if (res.data.status) {
                toast.success(res.data.message, {
                    position: "top-center",
                    pauseOnHover: false
                });

                this.status = res.data.data;
                this.statuses.push(this.status);

                console.log(this.status);
                router.push("/status");
            } else {
                toast.error(res.data.message, {});
                this.errors = res.data.message;
            }
        },

        async deleteStatus(id) {
            await axios.get("/sanctum/csrf-cookie");

            Swal.fire({
                title: 'Status Deletion',
                text: 'Are you sure you want to delete this?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if(result.isConfirmed) {

                    axios.delete(`/api/v1/status/${id}`).then((response) => {

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

                this.fetchAllStatuses();
              })


        },

        getLoggedInUser() {
            return this.user;
        },
    },
});

// export default useUsers;
