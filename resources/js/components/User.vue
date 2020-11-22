<template>
  <div class="user">
    <p v-show="this.isAdm" class="gradient-box">HI ADMIN :)</p>
    <p v-show="!user.edit"  :class="{'is-not-verified' : !user.isVerified, 'is-verified' :user.isVerified}">
      First Name : {{ user.FirstName }}<br />
      Last Name : {{ user.LastName }}<br />
      Phone : {{ user.Phone }}<br />
      Email : {{ user.Email }}<br />
      Postal Code: {{ user.PostalCode }}<br />
      National Code : {{ user.NationalCode }}<br />
      UserName : {{ user.UserName }}<br />
      Password : {{ user.Password }}<br />
      Is Active : {{ user.Active }}<br />
      Is Verified : {{ user.isVerified }}<br />
      <button
        class="edit"
        v-show="!user.edit && this.isAdm"
        v-on:click="edit_true"
      >
        E
      </button>
      <button class="edit" v-show="!user.edit" v-on:click="verify">V</button>
    </p>

    <div v-show="user.edit">
      First Name :<input
        type="text"
        ref="FirstName"
        :value="user.FirstName"
        :class="{ view: !user.edit }"
      /><br />

      Last Name :<input
        type="text"
        ref="LastName"
        :value="user.LastName"
        :class="{ view: !user.edit }"
      /><br />

      Phone :<input
        type="text"
        ref="Phone"
        :value="user.Phone"
        :class="{ view: !user.edit }"
      /><br />

      Email :<input
        type="text"
        ref="Email"
        :value="user.Email"
        :class="{ view: !user.edit }"
      /><br />

      Postal Code :<input
        type="text"
        ref="PostalCode"
        :value="user.PostalCode"
        :class="{ view: !user.edit }"
      /><br />

      National Code :<input
        type="text"
        ref="NationalCode"
        :value="user.NationalCode"
        :class="{ view: !user.edit }"
      /><br />

      User Name :<input
        type="text"
        ref="UserName"
        :value="user.UserName"
        :class="{ view: !user.edit }"
      /><br />

      Password :<input
        type="text"
        ref="Password"
        :value="user.Password"
        :class="{ view: !user.edit }"
      /><br />

      Active :<input
        type="text"
        ref="Active"
        :value="user.Active"
        :class="{ view: !user.edit }"
      /><br />
    </div>

    <button @click="save" v-if="user.edit">Save</button>
    <button @click="$emit('del-user', user.id)" class="del" v-if="user.edit">
      DEL
    </button>
    <button class="edit_off" v-on:click="edit_false" v-show="user.edit">
      Cancel
    </button>
  </div>
</template>


<script>
export default {
  name: "user",
  props: ["user", "isAdm"],
  methods: {
    edit_true: function () {
      console.log(this.isAdm);
      this.user.edit = true;
    },
    edit_false: function () {
      this.user.edit = false;
    },
    save() {
      this.user.FirstName = this.$refs["FirstName"].value;
      this.user.LastName = this.$refs["LastName"].value;
      this.user.Phone = this.$refs["Phone"].value;
      this.user.Email = this.$refs["Email"].value;
      this.user.PostalCode = this.$refs["PostalCode"].value;
      this.user.NationalCode = this.$refs["NationalCode"].value;
      this.user.UserName = this.$refs["UserName"].value;
      this.user.Password = this.$refs["Password"].value;
      this.user.Active = this.$refs["Active"].value;
      this.user.edit = !this.user.edit;
    },
    verify: function () {
      this.user.isVerified = !this.user.isVerified;
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