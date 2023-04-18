<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Login</h1>
                        <hr />
                        <form action="" class="row" method="post">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul class="mb-0"></ul>
                                </div>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" name="email" id="email" class="form-control" />
                            </div>
                            <div class="form-group col-12 my-2 mt-3">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control" />
                            </div>
                            <div class="col-12 mb-2 text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-block" @submit="login">Login
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label>Don't have an account?
                                    <router-link :to="{ name: 'register' }">Register Now!</router-link></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
setup() {

},
})
</script>
