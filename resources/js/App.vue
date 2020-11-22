<template>
  <div id="app">
    <Header />
    <div id="nav">
      <router-link
        v-if="this.authenticated"
        to="/login"
        v-on:click.native="logout()"
        replace
        >Logout</router-link
      >
    </div>
    <router-view @authenticated="setAuthenticated" />
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
  /*  mounted() {
            if(!this.authenticated) {
                this.$router.replace({ name: "login" });
            }
        },*/
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
  background-color: #f0f0f0;
  background-image: url("~@/assets/library2.jpeg");
  background-size: cover;
  display: grid;
  color:white;
}
h1 {
  padding: 0;
  margin-top: 0;
}
#app {
  width: 1024px;
  margin: auto;
  display: grid;

  /* direction: rtl; 
  font-family: iransans;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  overflow-x: hidden;*/
}

@font-face {
  font-family: iransans;
  src: url('../src/assets/font/iran.ttf');
}

*{
  font-family: iransans;
}

</style>