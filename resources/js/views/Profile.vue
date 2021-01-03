<template>
  <div id="profile">
    <User
      v-bind:user="currentUser"
      v-bind:userEdit="true"
    />
  </div>
</template>

<script>
import User from "../components/User";
import axios from "axios";
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Profile",
  data() {
    return {
      UserArray: [],
      currentUser:null ,
    };
  },

  components: {
    User,
  },

  computed: {
    ...mapGetters({ User: "StateUser" }),
    isLoggedIn: function () {
      return this.$store.getters.isAuthenticated;
    },
    isAdmin: function () {
      return this.$store.getters.isAdmin;
    },
    isStaff: function () {
      return this.$store.getters.isStaff;
    },
    isAdminOrStaff: function () {
      return this.$store.getters.isStaff || this.$store.getters.isAdmin;
    },
  },

  methods: {
    fetchUsers: async function () {
      var self = this;
      await axios
        .get("/api/management/user/patron/list")
        .then(function (response) {
          console.log(response);
          self.UserArray = response.data.data;
          //   console.log("BEFORE:", self.UserArray);
        })
        .catch(function (error) {
          console.log(error);
        });
      //   console.log("AFTER:", self.UserArray);
    },
    search(nameKey, myArray) {
      console.log(myArray.values);
      for (var i = 0; i < myArray.length; i++) {
        if (myArray[i].email === nameKey) {
          return myArray[i];
        }
      }
    },
  },

  async created() {
    await this.fetchUsers();
    var currentUserL = this.search(
      this.$store.getters.StateUser,
      this.UserArray
    );
    console.log("resultObject", currentUserL.first_name, currentUserL.last_name);
    this.currentUser = currentUserL;
  },
};
</script>

<style scoped>
</style>