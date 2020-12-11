<template>
  <div id="aum">
    <Users v-bind:UsersArr="UserArray" v-on:del-user="deleteUser" v-bind:isAdm="isAdmin"/>
  </div>
</template>

<script>
import Users from "../components/Users";

export default {
  name: "AUserManage",
  components: {
    Users,
  },
  methods: {
    deleteUser(id) {
      console.log("deleting User " + id);
      this.UserArray = this.UserArray.filter((user) => user.id !== id);
    },
    fetchUsers: function () {
      var self = this;
      axios
        .get("http://localhost:8000/api/management/user/patron/list")
        .then(function (response) {
          console.log(response);
          self.UserArray = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created() {
    this.fetchUsers();
  },

  data() {
    return {
      UserArray: [],
      isAdmin: true
    };
  },
};
</script>

<style scoped>
</style>