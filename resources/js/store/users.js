import axios from "axios";
import { defineStore } from "pinia";
import Swal from "sweetalert2/dist/sweetalert2.js";
import router from "../router";

export const useUsers = defineStore("user-store", {
    state: () => {
        return {
            users: [],
            user: "",
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
            await axios.get('/sanctum/csrf-cookie');
            const response = await axios.get("/api/v1/users");
            try {
                this.users = response.data.data
                return this.users;

            } catch (err) {
                this.users = [];
                console.error("Error fetching users:", err);
                return err;
            }
        },

        async registerUser(user) {
            await axios.get('/sanctum/csrf-cookie');
            const res = await axios.post("/api/v1/auth/register", user, {});

            // use sweetalert to redirect to the next page
            if (res.data.status === 201) {
                Swal.fire({
                    title: "Registration Successful!!",
                    text: res.data.message,
                    timer: 5000,
                });

                this.userAuthenticated = true;
                this.user = res.data.data;

                router.push("/login");

            } else {
                this.errors = res.data.message;
            }
        },

        async loginUser(user) {
            await axios.get('/sanctum/csrf-cookie');
            // console.log(r1);
            const res = await axios.post("/api/v1/auth/login", user, {});

            if (res.data.status === 302) {
                Swal.fire({
                    title: "User Login Successful!!",
                    text: res.data.message,
                    timer: 5000,
                });

                // redirect to the dashboard page
                this.user = res.data.data;
                this.userAuthenticated = true;

                console.log(this.user);
                router.push("/dashboard");
            } else {
                //populate the errors
                this.errors = res.data.message;
                console.log(this.errors);
            }
        },

        getLoggedInUser() {
            return this.user;
        },

        async logoutUser() {
            console.log("Logout the user");
        },
    },
});

// export default useUsers;
