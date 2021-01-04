<template>
  <div id="aum">
    <Users
      v-bind:UsersArr="UserArray"
      v-on:del-user="deleteUser"
    />
    
    <Staffs
      v-bind:StaffsArr="StaffsArray"
      v-on:del-staff="deleteStaff"
      v-bind:isAdm="isAdmin"
    />

  </div>
</template>

<script>
import Users from "../components/Users";
import Staffs from "../components/Staffs";
import axios from "axios";

export default {
  name: "AUserManage",
  components: {
    Users,
    Staffs,
  },

  methods: {
    async deleteUser(id) {
      console.log("deleting User " + id);
       this.UserArray = this.UserArray.filter((user) => user.id !== id);
      await axios
        .post("/api/management/user/delete", {
          user_id: id,
        })
        .then(function (response) {
          console.log(response);
          if (response.data.message == "Bad request!") {
            alert(response.data.data.error);
          } else {
            alert("User Deleted");
            vm.$forceUpdate();
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    async deleteStaff(id) {
      console.log("deleting User " + id);
      this.StaffsArray = this.StaffsArray.filter((staff) => staff.id !== id);
       await axios
        .post("/api/management/user/delete", {
          user_id: id,
        })
        .then(function (response) {
          console.log(response);
          if (response.data.message == "Bad request!") {
            alert(response.data.data.error);
          } else {
            alert("Staff Deleted");
            vm.$forceUpdate();
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    fetchUsers: async function () {
      var self = this;
      await axios
        .get("/api/management/user/patron/list")
        .then(function (response) {
          console.log(response);
          self.UserArray = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    fetchStaffs: async function () {
      var self = this;
      await axios
        .get("/api/management/user/staff/list")
        .then(function (response) {
          console.log(response);
          self.StaffsArray = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  async created() {
    await this.fetchUsers();
    await this.fetchStaffs();
  },

  data() {
    return {
      UserArray: [],
      StaffsArray: [],
      isAdmin: true,
    };
  },
};
</script>

<style scoped>
</style>