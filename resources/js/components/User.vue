<template>
  <div class="user">
    <p
      v-show="!is_editing"
      :class="{
        'is-not-verified': !user.isVerified,
        'is-verified': user.isVerified,
      }"
    >
      First Name : {{ user.first_name }}<br />
      Last Name : {{ user.last_name }}<br />
      Phone : {{ user.phone }}<br />
      Email : {{ user.email }}<br />
      Postal Code: {{ user.postal_code }}<br />
      National Code : {{ user.national_code }}<br />
      <button
        class="edit"
        v-show="!is_editing && this.isAdm"
        v-on:click="edit_true"
      >
        E
      </button>
      <button class="edit" v-show="!is_editing" v-on:click="verify">V</button>
    </p>

    <div v-show="is_editing">
      First Name :
      <b-form-input
        id="input-firstName"
        v-model="user.first_name"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="نام"
        :value="user.first_name"
        trim
      ></b-form-input>

      Last Name :
      <b-form-input
        id="input-lastName"
        v-model="user.last_name"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="نام خانوادگی"
        :value="user.last_name"
        trim
      ></b-form-input>

      Phone :
      <b-form-input
        id="input-phone"
        v-model="user.phone"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="نام خانوادگی"
        :value="user.phone"
        trim
      ></b-form-input>

      Email :
      <b-form-input
        id="input-email"
        v-model="user.email"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="ایمیل"
        :value="user.email"
        trim
      ></b-form-input>

      Postal Code :
      <b-form-input
        id="input-postal"
        v-model="user.postal_code"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="کد پستی"
        :value="user.postal_code"
        trim
      ></b-form-input>

      National Code :
      <b-form-input
        id="input-national"
        v-model="user.national_code"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="کد ملی"
        :value="user.national_code"
        trim
      ></b-form-input>
    </div>

    <button @click="save" v-if="is_editing">Save</button>
    <button @click="$emit('del-user', user.id)" class="del" v-if="is_editing">
      DEL
    </button>
    <button class="edit_off" v-on:click="edit_false" v-show="is_editing">
      Cancel
    </button>
  </div>
</template>


<script>
export default {
  name: "user",
  data() {
    return {
      is_editing: false,
    };
  },
  props: ["user", "isAdm"],

  methods: {
    edit_true: function () {
      console.log(this.isAdm);
      this.is_editing = true;
    },
    edit_false: function () {
      this.is_editing = false;
    },
    save() {
      // axios
      //   .post("http://localhost:8000/api/???", {
          
      //   })
      //   .then(function (response) {
      //     console.log(response);
      //   })
      //   .catch(function (error) {
      //     console.log(error);
      //   });
    },
    verify: function () {
      console.log(this.user.id);
      axios
        .post("http://localhost:8000/api/management/user/patron/verify", {
          user_id: this.user.id
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

.user {
  opacity: 0.95;
  padding: 0px;
  margin: 0px;
  color: floralwhite;
  background: rgb(105, 46, 6);
  padding: 10px;
  border-bottom: 1px #ccc dotted;
  color: white;
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