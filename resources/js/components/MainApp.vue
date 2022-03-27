<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Login Temperatures</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <router-link :to="{ name: 'home'}" class="nav-link">
                            Login Temperature List
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'login'}" class="nav-link">
                            Login
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'register'}" class="nav-link">
                            Register
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MainApp"
    }
</script>
