<template>
  <div id="svv">
    <Users v-bind:UsersArr="UserArray" v-on:del-user="deleteUser" v-bind:isAdm="isAdmin"/>
  </div>
</template>

<script>
import Users from "../components/Users";

export default {
  name: "StaffVerification",
  components: {
    Users,
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers: function () {
      var self = this;
      axios
        .get("/api/management/user/patron/list")
        .then(function (response) {
          console.log(response);
          self.UserArray = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  data() {
    return {
      UserArray: [],
      isAdmin: false,
    };
  },
};
</script>

<style>
</style>