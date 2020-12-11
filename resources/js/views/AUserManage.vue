<template>
  <div id="aum">
    <Users v-bind:UsersArr="UserArray" v-on:del-user="deleteUser" v-bind:isAdm="isAdmin"/>
    <Staffs v-bind:StaffsArr="StaffsArray" v-on:del-staff="deleteStaff" v-bind:isAdm="isAdmin"/>
  </div>
</template>

<script>
import Users from "../components/Users";
import Staffs from "../components/Staffs";

export default {
  name: "AUserManage",
  components: {
    Users,Staffs
  },
  methods: {
    deleteUser(id) {
      console.log("deleting User " + id);
      this.UserArray = this.UserArray.filter((user) => user.id !== id);
    },
    deleteStaff(id) {
      console.log("deleting User " + id);
      this.StaffsArray = this.StaffsArray.filter((staff) => staff.id !== id);
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
    fetchStaffs: function () {
      var self = this;
      axios
        .get("http://localhost:8000/api/management/user/staff/list")
        .then(function (response) {
          console.log(response);
          self.StaffsArray = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created() {
    this.fetchUsers();
    this.fetchStaffs();
  },

  data() {
    return {
      UserArray: [],
      StaffsArray: [],
      isAdmin: true
    };
  },
};
</script>

<style scoped>
</style>