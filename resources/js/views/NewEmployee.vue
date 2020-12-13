<template>
  <div class="container-fluid employee-container">
    <div class="row mt-4">
      <div class="col-lg-2 col-5">
        <b-button
          class="btn btn-light d-flex new-employee-btn"
          v-b-modal.modal-1
          >کارمند جدید</b-button
        >
      </div>

      <b-modal id="modal-1" title="اضافه کردن کارمند" hide-footer>
        <div class="container-fluid p-0 d-flex justify-content-center">
          <b-form @submit="submitStaff" class="row col-12 p-0">
            <b-form-group
              class="col-lg-6"
              id="input-group-1"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                type="text"
                v-model="first_name"
                required
                placeholder="نام "
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-2"
              label-for="input-2"
            >
              <b-form-input
                id="input-2"
                type="text"
                v-model="last_name"
                required
                placeholder="نام خوانوادگی"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-3"
              label-for="input-3"
            >
              <b-form-input
                id="input-3"
                type="text"
                v-model="national_code"
                required
                placeholder="کد ملی"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-4"
              label-for="input-4"
            >
              <b-form-input
                id="input-4"
                type="text"
                v-model="phone"
                required
                placeholder="شماره تماس"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-5"
              label-for="input-5"
            >
              <b-form-input
                id="input-5"
                type="text"
                v-model="mobile"
                required
                placeholder="شماره همراه"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-6"
              label-for="input-6"
            >
              <b-form-input
                id="input-6"
                type="text"
                v-model="postal_code"
                required
                placeholder="کد پستی "
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-7"
              label-for="input-7"
            >
              <b-form-input
                id="input-7"
                type="text"
                v-model="email"
                required
                placeholder="ایمیل"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-8"
              label-for="input-8"
            >
              <b-form-input
                id="input-8"
                type="text"
                v-model="password"
                required
                placeholder="رمز عبور"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-9"
              label-for="input-9"
            >
              <b-form-input
                id="input-9"
                type="text"
                v-model="password_confirmation"
                required
                placeholder="تایید رمز عبور"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-10"
              class="col-lg-12"
              label-for="input-10"
            >
              <b-form-select v-model="selected" id="input-9" required>
                <option>وضعیت</option>
                <option>فعال</option>
                <option>غیرفعال</option>
              </b-form-select>
            </b-form-group>
            <div class="d-flex justify-content-center col-12">
              <b-button type="submit" class="btn new-employee"
                >اضافه کردن</b-button
              >
            </div>
          </b-form>
        </div>
      </b-modal>
      <div class="header col-lg-8 col-7">
        <h4>لیست کارمندان</h4>
      </div>
    </div>
    <table class="table mt-4">
      <thead class="thead-dark">
        <tr>
          <th scope="col">شناسه</th>
          <th scope="col">نام کاربری</th>
          <th scope="col">کد ملی</th>
        </tr>
      </thead>
      <tbody>
        <tr v-bind:key="staff.id" v-for="staff in StaffsArray">
          <th scope="row">{{ staff.id }}</th>
          <td>{{ staff.first_name }} {{ staff.last_name }}</td>
          <td>{{ staff.national_code }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      selected: "وضعیت",
      StaffsArray: [],
      first_name: "",
      last_name: "",
      national_code: "",
      phone: "",
      mobile: "",
      address: "",
      postal_code: "",
      email: "",
      password: "",
      password_confirmation: "",
    };
  },
  created() {
    this.fetchStaffs();
  },
  methods: {
    fetchStaffs: function () {
      var self = this;
      axios
        .get("/api/management/user/staff/list")
        .then(function (response) {
          console.log(response);
          self.StaffsArray = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    submitStaff: function () {
      console.log("Adding");
      var self = this;
      axios
        .post("/api/management/user/staff/add", {
          first_name: self.first_name,
          last_name: self.last_name,
          national_code: self.national_code,
          phone: self.phone,
          mobile: self.mobile,
          address: self.address,
          postal_code: self.postal_code,
          email: self.email,
          password: self.password,
          password_confirmation: self.password_confirmation,
        })
        .then(function (response) {
          console.log(response);
          if (response.data.message == "Bad request!") {
            alert(response.data.data.error);
          } else {
            alert("Book added");
            //vm.$forceUpdate(); //location.relode()'
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
.employee-container {
  padding: 96px;
}
.new-employee-btn {
  background-color: #1f369a;
  color: white;
}
.new-employee-btn:hover {
  background-color: #1c5ee4;
  color: white;
}
form {
  direction: rtl;
}
.new-employee {
  background-color: #133ef7;
}
.new-employee:hover {
  background-color: #1c0097 !important;
}
.header h4 {
  font-weight: 800;
}
@media screen and (max-width: 700px) {
  .employee-container {
    padding: 0;
  }
}
</style>
<style>
.modal-content {
  box-shadow: 5px 23px 23px 15px #00000057 !important;
}
.modal-dialog {
  min-width: 761px;
}
@media screen and (max-width: 700px) {
  .modal-dialog {
    min-width: unset;
  }
}
small {
  font-size: 14px !important;
}
</style>