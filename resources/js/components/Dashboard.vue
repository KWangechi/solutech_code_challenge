<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <router-link
                :to="{ name: 'dashboard' }"
                active-class="dashboard-active-link"
                class="nav-link"
                >Dashboard(current) <span class="sr-only"></span
              ></router-link>
            </li>
            <li class="nav-item">
              <router-link
                :to="{ name: 'users' }"
                active-class="active-link"
                class="nav-link"
                >Users <span class="sr-only"></span
              ></router-link>
            </li>
            <li class="nav-item">
              <router-link
                :to="{ name: 'tasks' }"
                active-class="active-link"
                class="nav-link"
                >Tasks</router-link
              >
            </li>
            <li class="nav-item">
              <router-link
                :to="{ name: 'status' }"
                active-class="active-link"
                class="nav-link"
                >Statuses <span class="sr-only"></span
              ></router-link>
            </li>
            <li class="nav-item">
              <router-link active-class="active-link" class="nav-link" :to="{ name: 'user_tasks' }"
                >User Tasks <span class="sr-only"></span
              ></router-link>
            </li>

            <li class="nav-item">
              <router-link active-class="active-link" class="nav-link" :to="{ name: 'user_tasks' }"
                >Reports <span class="sr-only"></span
              >
              
              </router-link>
            </li>

          </ul>
          <div class="d-flex">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdownMenuLink"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  {{ user.email }}
                </a>
                <div
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuLink"
                >
                  <button class="dropdown-item" @click.prevent="logout">Logout</button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <main class="mt-3">
      <h3 class="text-center">Welcome to the Dashboard</h3>
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
import { mapState } from "pinia";
import { useUsers } from "../store/users";

const userStore = useUsers();

export default {
  data() {
    return {
      user: userStore.getUser,
      users: [],
    };
  },

  created() {
    console.log(userStore.getLoggedInUser());
    this.getAllUsers();
  },
  methods: {
    logout() {
      userStore.logoutUser();
    },
    async getAllUsers() {
      // userStore.fetchAllUsers();
      this.users = await userStore.fetchAllUsers();
      console.log(this.users);
    },
  },
};
</script>
<style scoped>
.active-link {
  background-color: grey;
}
.dashboard-active-link {
  background-color: lightblue;

}
</style>
