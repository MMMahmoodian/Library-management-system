<template>
  <div id="Users_div">
    <div>

      <b-card-group v-bind:key="user.id" v-for="user in UsersArr">
        <User
          v-bind:user="user"
          v-on:del-user="$emit('del-user', user.id)"
        />
      </b-card-group>
      
    </div>
  </div>
</template>

<script>
import User from "./User.vue";

export default {
  name: "Users",
  created() {},
  props: ["UsersArr", "isAdm"],
  components: {
    User,
  },
};
</script>

<style>
</style>
