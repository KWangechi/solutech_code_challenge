<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="https://techvblogs.com/blog/spa-authentication-laravel-9-sanctum-vue3-vite" target="_blank">TechvBlogs</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <router-link :to="{name:'example'}" class="nav-link">Home(current) <span class="sr-only"></span></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name:'dashboard'}" class="nav-link">Dashboard <span class="sr-only"></span></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name:'login'}" class="nav-link">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name:'register'}" class="nav-link">Register <span class="sr-only"></span></router-link>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="javascript:void(0)">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main class="mt-3">
            <router-view></router-view>
        </main>
    </div>
</template>
