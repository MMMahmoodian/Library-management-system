<template>
  <header class="header">
    <div id="nav">
      <div v-if="showLog"  >LOGGED IN</div> <br />
      <router-link to="/">Home</router-link> |
      <!-- <router-link to="/About">About</router-link> | -->
      <router-link to="/SBookManage"> Staff Book Management </router-link> |
      <router-link to="/StaffVerification"> Staff Verification </router-link> |
      <router-link to="/AUserManage"> Admin User Management </router-link> |
      <router-link to="/NewEmployee"> New Employee </router-link> |
      <router-link to="/NewBook"> New Book </router-link> |
      <router-link to="/Category"> Category </router-link> |
      <router-link to="/Register"> Register </router-link> |
      <router-link to="/login">Login </router-link>
      <!-- <button v-on:click="toggle()">toggle</button>
      <button v-on:click="show()">show </button> -->
    </div>
  </header>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      showLog: false,
    };
  },
  mounted() {
  },
  updated(){
    
  },
  methods: {
    show() {
      console.log("Storage:"+sessionStorage.getItem("auth"));
      console.log("Local:"+this.showLog);
    },
    toggle() {
      this.showLog = !this.showLog;
      sessionStorage.setItem("auth", this.showLog );
    },
    check(){
      return sessionStorage.getItem("auth");
    }
  },
};
</script>

<style scoped>
.header {
  padding: 60px;
  background: #333;
  color: white;
  text-align: center;
  padding: 10px;
  font-size: 30px;
}

.header a {
  color: #fff;
  padding-right: 5px;
  text-decoration: none;
}
</style>