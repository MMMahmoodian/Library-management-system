<template>
    <div id="app">
        <Header/>
        <div id="nav">
            <router-link
                    v-if="this.authenticated"
                    to="/login"
                    v-on:click.native="logout()"
                    replace
            >Logout
            </router-link
            >
        </div>
        <router-view @authenticated="setAuthenticated"/>
    </div>
</template>

<script>
    import Header from "./components/layouts/Header";

    export default {
        name: "App",
        data() {
            return {
                mockAccount: {
                    authenticated: false,
                    isVerified: false,
                    username: "danial",
                    password: "12",
                },
            };
        },
        components: {
            Header,
        },

        methods: {
            setAuthenticated(status) {
                this.authenticated = status;
            },
            logout() {
                this.authenticated = false;
            },
        },
    };
</script>

<style>
    body {
        background-size: cover;
        display: grid;
        color: black !important;
    }

    @font-face {
        font-family: iransans;
        src: url('../../public/fonts/iran.ttf');
    }

    h1 {
        padding: 0;
        margin-top: 0;
    }

    #app {
        width: 1400px;
        margin: auto;
        display: grid;
        direction: rtl;
        font-family: iransans;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 20px;
        overflow-x: hidden;
    }

    * {
        font-family: iransans;
    }
</style>

