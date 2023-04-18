<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Register</h1>
                        <hr/>
                        <form action="javascript:void(0)" class="row" method="post">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">

                                    </ul>
                                </div>
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" name="email"  id="email" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" name="password"  id="password" placeholder="Enter Password" class="form-control">
                            </div>
                            <!-- <div class="form-group col-12 my-2">
                                <label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
                                <input type="password_confirmation" name="password_confirmation" id="password_confirmation" placeholder="Enter Password" class="form-control">
                            </div> -->
                            <div class="col-12 mb-2">
                                <!-- <button type="submit" :disabled="processing" class="btn btn-primary btn-block">
                                    {{ processing ? "Please wait" : "Register" }}
                                </button> -->
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
