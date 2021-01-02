<template>
  <div id="svv">

    <Users
      v-bind:UsersArr="UserArray"
    />

  </div>
</template>

<script>

import Users from "../components/Users";
import axios from "axios";

export default {
  name: "StaffVerification",
  components: {
    Users,
  },
  data() {
    return {
      UserArray:[],
    };
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
};
</script>

<style>
</style>
