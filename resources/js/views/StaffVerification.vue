<template>
  <div id="svv">
    <!--<Users v-bind:UsersArr="UserArray" v-on:del-user="deleteUser" v-bind:isAdm="isAdmin"/>-->
    <b-table
      class="mt-5"
      head-variant="dark"
      striped
      hover
      :items="UserArray"
      :fields="fields"
    ></b-table>
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
      fields: [
        {
          key: "first_name",
          label: "نام",
          sortable: true,
        },
        {
          key: "last_name",
          label: "نام خانوادگی",
          sortable: false,
        },
        {
          key: "phone",
          label: "شماره تماس",
          sortable: false,
        },
        {
          key: "email",
          label: "ایمیل",
          sortable: false,
        },
        {
          key: "postal_code",
          label: "کد پستی",
          sortable: false,
        },
        {
          key: "national_code",
          label: "کد ملی",
          sortable: false,
        },
      ],
      UserArray: [],
      isAdmin: false,
    };
  },
  created() {
      this.fetchUsers();
  },
  methods: {
      fetchUsers: function () {
          var self = this;
          axios.get("/api/management/user/patron/list")
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
