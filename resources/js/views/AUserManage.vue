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
  },
  data() {
    return {
      UserArray: [
        {
          id: 1,
          FirstName: "Mohammad",
          LastName: "Mohammadi",
          Phone: "021-22313242",
          BirthDay: "dd/mm/yyyy",
          Email: "qfefe@yahoo.com",
          PostalCode: "16662324213",
          NationalCode: "2231423674",
          UserName: "User1",
          Password: "Pass1",
          Active: true,
          isLoggedIn: false,
          isSystemReserved: false,
          isVerified: false,
          edit: false,
        },
      ],
    isAdmin: true
    };
  },
};
</script>

<style scoped>
</style>