<template>
  <div id="app">
    <Header />
    <div id="nav">
    </div>
    <router-view  />
  </div>
</template>

<script>
import Header from "./components/layouts/Header";

export default {
  name: "App",
  data() {
    return {
    };
  },
  components: {
    Header,
  },

  methods: {
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
  src: url("./assets/font/iran.ttf");
}

h1 {
  padding: 0;
  margin-top: 0;
}

#app {
  width: 1500px;
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

