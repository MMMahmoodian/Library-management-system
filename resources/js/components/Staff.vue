<template>
  <div class="staff">
    <p
      v-show="!is_editing"
      :class="{
        'is-not-verified': !staff.verified,
        'is-verified': staff.verified,
      }"
    >
      First Name : {{ staff.first_name }}<br />
      Last Name : {{ staff.last_name }}<br />
      Phone : {{ staff.phone }}<br />
      Email : {{ staff.email }}<br />
      Postal Code: {{ staff.postal_code }}<br />
      National Code : {{ staff.national_code }}<br />
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
        v-model="staff.first_name"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="نام"
        :value="staff.first_name"
        trim
      ></b-form-input>

      Last Name :
      <b-form-input
        id="input-lastName"
        v-model="staff.last_name"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="نام خانوادگی"
        :value="staff.last_name"
        trim
      ></b-form-input>

      Phone :
      <b-form-input
        id="input-phone"
        v-model="staff.phone"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="نام خانوادگی"
        :value="staff.phone"
        trim
      ></b-form-input>

      Email :
      <b-form-input
        id="input-email"
        v-model="staff.email"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="ایمیل"
        :value="staff.email"
        trim
      ></b-form-input>

      Postal Code :
      <b-form-input
        id="input-postal"
        v-model="staff.postal_code"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="کد پستی"
        :value="staff.postal_code"
        trim
      ></b-form-input>

      National Code :
      <b-form-input
        id="input-national"
        v-model="staff.national_code"
        aria-describedby="input-live-help input-live-feedback"
        placeholder="کد ملی"
        :value="staff.national_code"
        trim
      ></b-form-input>
    </div>

    <button @click="save" v-if="is_editing">Save</button>
    <button @click="$emit('del-staff', staff.id)" class="del" v-if="is_editing">
      DEL
    </button>
    <button class="edit_off" v-on:click="edit_false" v-show="is_editing">
      Cancel
    </button>
  </div>
</template>


<script>
export default {
  name: "staff",
  data() {
    return {
      is_editing: false,
    };
  },
  props: ["staff", "isAdm"],

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
      console.log(this.staff.id);
      axios
        .post("http://localhost:8000/api/management/user/patron/verify", {
          user_id: this.staff.id
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

.staff {
  opacity: 0.95;
  padding: 0px;
  margin: 0px;
  color: floralwhite;
  background: rgb(231, 133, 68);
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