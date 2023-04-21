<template>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow md mt-5">
                    <div class="card-body">
                        <h3 class="text-center">
                            Edit User Tasks - {{  }}
                        </h3>
                        <hr />
                        <form
                            class="row"
                            method="post"
                            @submit.prevent="updateStatus(status)"
                        >
                            <div class="col-12">
                                <div class="alert alert-danger" v-if="errors">
                                    {{ errors }}
                                    <ul class="mb-0"></ul>
                                </div>
                            </div>
                            <div class="form-group col-12 my-2 mt-3">
                                <label for="email" class="font-weight-bold"
                                    >Status Name</label
                                >
                                <input
                                    type="text"
                                    name="status_name"
                                    v-model="status.name"
                                    id="email"
                                    placeholder="Enter Status Name"
                                    class="form-control mt-3"
                                />
                            </div>

                            <div class="row mb-2 mt-4">
                                <div class="col-sm-5 col-md-6">
                                    <router-link :to="{ name: 'status' }">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                        >
                                            Back
                                        </button>
                                    </router-link>
                                </div>
                                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
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

const statusStore = useStatuses();

export default {
    data() {
        return {
            status: "",
        };
    },
    computed: {
        ...mapState(useStatuses, {
            errors: "getErrors",
        }),
    },

    mounted() {
        this.getLoadedStatus();
    },
    methods: {
        ...mapActions(useStatuses, {
            getAllStatuses: "fetchAllStatuses",
        }),

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
