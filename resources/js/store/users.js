import axios from "axios";
import { defineStore } from "pinia";
import Swal from "sweetalert2/dist/sweetalert2.js";
import router from "../router";
import "vue3-toastify/dist/index.css";
import { toast } from "vue3-toastify";

export const useUsers = defineStore("user-store", {
    state: () => {
        return {
            users: [],
            user: {},
            errors: "",
            userAuthenticated: false,
        };
    },

    getters: {
        allUsers(state) {
            return state.users;
        },

        getErrors(state) {
            return state.errors;
        },
        getUser(state) {
            return state.user;
        },
    },

    actions: {
        async fetchAllUsers() {
            // await axios.get("/sanctum/csrf-cookie");

            const response = await axios.get("/api/v1/users", {
                headers: {Authorization: `Bearer ${localStorage.getItem('auth_token')}`}
            });

            try {
                this.users = response.data.data;
                return this.users;
            } catch (err) {
                this.users = [];
                console.error("Error fetching users:", err);
                return err;
            }
        },

        async getLoggedInUser() {
            // await axios.get("/sanctum/csrf-cookie");

            let response = await axios.get("/api/v1/user", {
                headers: {Authorization: `Bearer ${localStorage.getItem('auth_token')}`}
            });

            this.user = response.data;
            console.log(this.user);


            return this.user;
        },

        async registerUser(user) {
            const res = await axios.post("/api/v1/auth/register", user, {});

            // use sweetalert to redirect to the next page
            if (res.data.status) {
                toast.success(res.data.message, {});

                this.userAuthenticated = true;
                this.errors = "";
                this.user = res.data.data;

                router.push("/login");
            } else {
                toast.error(res.data.message, {});

                this.errors = res.data.message;
            }
        },

        async loginUser(user) {
           const res = await axios.post("/api/v1/auth/login", user, {});

            if (res.data.status) {
                this.user = res.data.data;

                this.errors = "";

                //store the token also
                localStorage.setItem("auth_token", res.data.token);
                localStorage.setItem("userAuthenticated", true);

                this.userAuthenticated = true;
                console.log(localStorage.getItem("auth_token"));

                toast.success(res.data.message, {});

                console.log(this.user);

                // redirect to the dashboard page
                router.push("/");
            } else {
                toast.error(res.data.message, {});

                this.errors = res.data.message;
            }
        },

        async logoutUser() {
            // await axios.get("/sanctum/csrf-cookie");

            const res = await axios.post("/api/v1/auth/logout", {}, {
                headers: {Authorization: `Bearer ${localStorage.getItem('auth_token')}`}
            });

            if (res.data.status) {
                this.user = "";
                this.userAuthenticated = false;
                localStorage.removeItem("auth_token");
                localStorage.removeItem("userAuthenticated");

                toast.success(res.data.message, {});

                // console.log(this.user);

                console.log(localStorage.getItem("auth_token"));

                // redirect to the dashboard page
                router.replace("/login");
            } else {
                toast.error(res.data.message, {});

                this.errors = res.data.message;

                console.log(this.errors);
            }
        },
    },
});
