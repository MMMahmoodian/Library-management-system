<template>
  <header class="header">
    <div id="nav">
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

    </div>
  </header>
</template>

<script>
export default {
  name: "Header",
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