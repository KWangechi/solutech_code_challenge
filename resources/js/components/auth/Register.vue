<template>
    <div class="container justify-center content-center mt-5">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm ">
                    <div class="card-body">
                        <h1 class="text-center">Register</h1>
                        <hr/>
                        <form class="row" method="post" @submit.prevent="register">
                            <div class="col-12">
                                <div class="alert alert-danger" v-if="errors">
                                {{ errors }}
                                    <ul class="mb-0"></ul>
                                </div>
                            </div>
                            <div class="form-group col-12 my-2 mt-3">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" name="email" v-model="user.email" id="email" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" name="password" v-model="user.password" id="password" placeholder="Enter Password" class="form-control">
                            </div>
                            <!-- <div class="form-group col-12 my-2">
                                <label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
                                <input type="password_confirmation" name="password_confirmation" id="password_confirmation" placeholder="Enter Password" class="form-control">
                            </div> -->
                            <div class="col-12 mb-2 mt-3 text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label>Already have an account? <router-link :to="{name:'login'}">Login Now!</router-link></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useUsers } from '../../store/users';
import { mapState, mapActions } from 'pinia'

const userStore = useUsers();

export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            }
        }
    },
    computed: {
        ...mapState(useUsers, {
            errors: 'errors'
        })
    },
    methods: {
        ...mapActions(useUsers, ['getAllUsers']),

        async register() {
            await userStore.registerUser(this.user);
        }
    }
}
</script>
