<template>
  <div class="tables mt-8">
    <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th class="col">ID</th>
          <th class="col">Email</th>
          <th class="col">Created At</th>
          <th class="col">Updated At</th>
        </tr>
      </thead>
      <tbody v-if="users.length > 0">
        <tr v-for="(user, index) in users" :key="index">
          <td>{{ user.id }}</td>
          <td class="table-secondary">{{ user.email }}</td>
          <td class="table-success">{{ user.created_at }}</td>
          <td class="table-danger">{{ user.updated_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapState } from "pinia";
import { useUsers } from "../../store/users";

const userStore = useUsers();

export default {
  data() {
    return {
      user: userStore.getUser,
    };
  },
  computed: {
    ...mapState(useUsers, {
            users: 'allUsers'
        })
  },
  mounted() {
    console.log(userStore.getLoggedInUser());
    this.getAllUsers();
  },
  methods: {
    logout() {
      console.log("Logout the user");
    },
    async getAllUsers() {
      this.users = await userStore.fetchAllUsers();
      console.log(this.users);
    },
  },
};
</script>
