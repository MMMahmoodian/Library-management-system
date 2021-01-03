<template>
  <div class="staff">
    <b-card img-alt="Card image" img-right class="mb-3">
      <b-card-title>{{ staff.first_name }} {{ staff.last_name }}</b-card-title>
      <b-card-text class="disable_this">
        This is a wider card with supporting text below as a natural lead-in to
        additional content. This content is a little bit Lorem ipsum dolor sit
        amet consectetur adipisicing elit.
      </b-card-text>
      
      <b-list-group flush v-if="!is_editing">
        <b-list-group-item>شماره تماس : {{ staff.phone }}</b-list-group-item>
        <b-list-group-item>پست الکترونیک : {{ staff.email }}</b-list-group-item>
        <b-list-group-item
          >شماره پستی : {{ staff.postal_code }}</b-list-group-item
        >
        <b-list-group-item
          >شماره ملی : {{ staff.national_code }}</b-list-group-item
        >
        <b-list-group-item
          >نقش : کارمند کتابخانه</b-list-group-item
        >
      </b-list-group>

      <b-form @submit="save" v-if="is_editing">
        <b-form-group id="input-group-1" label="نام" label-for="input-1">
          <b-form-input
            id="input-1"
            v-model="staff.first_name"
            placeholder="staff.first_name"
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
            v-model="staff.last_name"
            placeholder="staff.last_name"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-3" label="شماره تماس" label-for="input-3">
          <b-form-input
            id="input-3"
            v-model="staff.phone"
            placeholder="staff.phone"
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
            v-model="staff.email"
            placeholder="staff.email"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-5" label="کد پستی" label-for="input-5">
          <b-form-input
            id="input-5"
            v-model="staff.postal_code"
            placeholder="staff.postal_code"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-6" label="کد ملی" label-for="input-6">
          <b-form-input
            id="input-5"
            v-model="staff.national_code"
            placeholder="staff.national_code"
            required
          ></b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">ثبت</b-button>
        <b-button @click="edit_false" variant="danger">خروج</b-button>
      </b-form>


      <template #footer>
        <small class="text-muted">{{
          staff.verified == false ? "تایید نشده" : "تایید شده"
        }}</small>
        <b-button variant="primary" class="btn d-flex" @click="edit_toggle"
          >ادیت</b-button
        >
      </template>
    </b-card>
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
  props: ["staff"],

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
      axios
        .post("/api/management/user/edit", {
          user_id: self.staff.id,
          first_name: self.staff.first_name,
          last_name: self.staff.last_name,
          phone: self.staff.phone,
          email: self.staff.email,
          postal_code: self.staff.postal_code,
          national_code: self.staff.national_code,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
        this.is_editing = false;
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
.disable_this {
  color: white;
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