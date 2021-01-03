<template>
  <div class="user">
    <b-card img-alt="Card image" img-right class="mb-3">
      <b-card-title>{{ user.first_name }} {{ user.last_name }}</b-card-title>
      <b-card-text class="disable_this">
        This is a wider card with supporting text below as a natural lead-in to
        additional content. This content is a little bit Lorem ipsum dolor sit
        amet consectetur adipisicing elit.
      </b-card-text>
      <b-form @submit="save" v-if="is_editing">
        <b-form-group id="input-group-1" label="نام" label-for="input-1">
          <b-form-input
            id="input-1"
            v-model="user.first_name"
            placeholder="user.first_name"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group
          id="input-group-2"
          label="نام خانوادگی"
          label-for="input-2"
        >
          <b-form-input
            id="input-2"
            v-model="user.last_name"
            placeholder="user.last_name"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-3" label="شماره تماس" label-for="input-3">
          <b-form-input
            id="input-3"
            v-model="user.phone"
            placeholder="user.phone"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group
          id="input-group-4"
          label="پست الکترونیک"
          label-for="input-4"
        >
          <b-form-input
            id="input-4"
            v-model="user.email"
            placeholder="user.email"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-5" label="کد پستی" label-for="input-5">
          <b-form-input
            id="input-5"
            v-model="user.postal_code"
            placeholder="user.postal_code"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-6" label="کد ملی" label-for="input-6">
          <b-form-input
            id="input-5"
            v-model="user.national_code"
            placeholder="user.national_code"
            required
          ></b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">ثبت</b-button>
        <b-button @click="edit_false" variant="danger">خروج</b-button>
      </b-form>

      <b-list-group flush v-if="!is_editing">
        <b-list-group-item>شماره تماس : {{ user.phone }}</b-list-group-item>
        <b-list-group-item>پست الکترونیک : {{ user.email }}</b-list-group-item>
        <b-list-group-item
          >شماره پستی : {{ user.postal_code }}</b-list-group-item
        >
        <b-list-group-item
          >شماره ملی : {{ user.national_code }}</b-list-group-item
        >
        <b-list-group-item
          >نقش : کاربر عادی</b-list-group-item
        >
        <b-list-group-item>{{
          user.Active == false ? "غیرفعال" : "فعال"
        }}</b-list-group-item>
      </b-list-group>

      <template #footer>
        <small class="text-muted">{{
          user.verified == false ? "تایید نشده" : "تایید شده"
        }}</small>
        <b-button v-if="canEdit" variant="primary" class="btn d-flex" @click="edit_toggle"
          >ادیت</b-button
        >
        <b-button v-if="isAdminOrStaff" :disabled="user.verified" variant="success" class="btn d-flex" @click="verify"
          > تایید </b-button
        >
      </template>
    </b-card>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "user",
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
      return (this.$store.getters.isStaff) || (this.$store.getters.isAdmin);
    },
    canEdit: function() {
      return this.isAdmin || this.userEdit;
    },
  },
  data() {
    return {
      is_editing: false,
    };
  },
  props: ["user", "userEdit"],

  methods: {
    edit_true: function () {
      console.log(this.isAdm);
      this.is_editing = true;
    },
    edit_false: function () {
      this.is_editing = false;
    },
    edit_toggle: function () {
      this.is_editing = !this.is_editing;
    },

    pass() {
      console.log("passed");
    },

    save() {
      var self = this;
      console.log("Saving");
      axios
        .post("/api/management/user/edit", {
          user_id: self.user.id,
          first_name: self.user.first_name,
          last_name: self.user.last_name,
          phone: self.user.phone,
          email: self.user.email,
          postal_code: self.user.postal_code,
          national_code: self.user.national_code,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
        this.is_editing = false;
    },

    verify: function () {
      console.log(this.user.id);
      axios
        .post("/api/management/user/patron/verify", {
          user_id: this.user.id,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
.is-verified {
  border: 2px solid green;
}

.is-not-verified {
  border: 2px dotted red;
}
.disable_this {
  color: white;
}
.user {
  opacity: 0.95;
  padding: 0px;
  margin: 0px;
  color: floralwhite;
  padding: 10px;
  border-bottom: 1px #ccc dotted;
  color: black;
}

.edit {
  background: rgb(235, 172, 101);
  color: black;
  border: none;
  padding: 5px 9px;
  border-radius: 50%;
  cursor: pointer;
  float: right;
}

.edit_on {
  background: rgb(235, 172, 101);
  color: black;
  border: none;
  padding: 5px 9px;
  border-radius: 50%;
  cursor: pointer;
  float: right;
}

.del {
  background: #ff0000;
  color: #fff;
  border: none;
  padding: 5px 9px;
  border-radius: 50%;
  cursor: pointer;
  float: right;
}
</style>
