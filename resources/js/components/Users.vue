<template>
  <div id="Users_div">
    <div v-bind:key="user.id" v-for="user in UsersArr">
      <User v-bind:user="user" v-on:del-user="$emit('del-user', user.id)" v-bind:isAdm="isAdm" />
    </div>
  </div>
</template>

<script>
import User from "./User.vue"

export default {
  name: "Users",
  props: ["UsersArr", "isAdm"],
  components:{
      User
  }
};
</script>

<style>
</style>