<template>
  <div class="container-fluid register-container">
    <div class="row col-lg-10 col-11 register-row p-0">
      <div class="col-lg-6 p-0">
        <div>
          <div>
            <img
              src="../assets/pics/librarylogo.png"
              width="115px"
              height="115px"
              alt="logo"
            />
          </div>
          <h4 class="register-title">ثبت نام</h4>
        </div>
        <div class="row p-3">
          <b-form class="row col-12 pl-0">
            <b-form-group
              class="col-lg-6"
              id="input-group-1"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                type="text"
                required
                v-model="first_name"
                placeholder="نام"
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
                placeholder="نام خانوادگی"
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
                required
                v-model="mobile"
                placeholder="تلفن همراه"
                @keypress="isNumber($event)"
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
                required
                v-model="phone"
                placeholder="تلفن"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-12"
              id="input-group-3"
              label-for="input-3"
            >
              <b-form-input
                id="input-3"
                type="text"
                required
                v-model="national_code"
                placeholder="کد ملی"
                @keypress="isNumber($event)"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-12"
              id="input-group-6"
              label-for="input-6"
            >
              <b-form-input
                id="input-6"
                type="email"
                required
                v-model="email"
                placeholder="پست الکترونیکی"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              class="col-lg-12"
              id="input-group-7"
              label-for="input-7"
            >
              <b-form-input
                id="input-7"
                type="text"
                required
                v-model="postal_code"
                placeholder="کد پستی"
                @keypress="isNumber($event)"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-12"
              id="input-group-8"
              label-for="input-8"
            >
              <b-form-input
                id="input-9"
                type="password"
                required
                v-model="password"
                placeholder="رمز عبور"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-12"
              id="input-group-9"
              label-for="input-9"
            >
              <b-form-input
                id="input-10"
                type="password"
                required
                v-model="password_conf"
                placeholder="تایید رمز عبور"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-10"
              class="col-lg-12"
              label-for="input-10"
            >
              <b-form-textarea
                id="textarea-rows"
                placeholder="آدرس"
                v-model="address"
                rows="3"
              ></b-form-textarea>
            </b-form-group>

            <div class="d-flex justify-content-center col-12">
              <b-button
                type="submit"
                class="btn btn-register"
                v-on:click="submitUser"
                >ثبت نام</b-button
              >
            </div>
          </b-form>
        </div>
      </div>
      <div class="col-lg-6 p-0 register-pic-row">
        <img
          src="../assets/pics/RegisterPic.jpg"
          alt="register-pic"
          class="register-pic w-100 h-100"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    submitUser: function () {
      axios
        .post("/api/user/register", {
          first_name: this.first_name,
          last_name: this.last_name,
          phone: this.phone,
          mobile: this.mobile,
          address: this.address,
          national_code: this.national_code,
          postal_code: this.postal_code,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_conf,
        })
        .then(function (response) {
          console.log(response);

          if (response.data.message == "Bad request!") {
            alert(response.data.data.error);
          } else {
            alert("User added");
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  data() {
    return {
      first_name: "",
      last_name: "",
      phone: "",
      mobile: "",
      national_code: "",
      email: "",
      address: "",
      postal_code: "",
      password: "",
      password_conf: "",
      selected: "جنسیت",
      date: "",
    };
  },
};
</script>

<style scoped>
.register-container {
  background-color: #e2e2e2;
  padding: 92px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.register-row {
  border: 0.5px solid rgb(172 172 172 / 45%);
  border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;
  box-shadow: 1px 6px 50px 15px #808080ad;
}
.register-pic {
  filter: grayscale();
}
.register-title {
  font-weight: bold;
  color: black !important;
}
input {
  border-radius: 7px;
}
.btn-register {
  background-color: #25d366;
  border-color: #25d366;
}
.btn-register:hover {
  background-color: #039c10;
  border-color: #039c10;
}
@media screen and (max-width: 700px) {
  .register-container {
    padding: 0;
  }
  .register-pic-row {
    display: none;
  }
  .register-row {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0.5px solid rgb(172 172 172 / 45%);
    border-top-right-radius: 20px;
    border-top-left-radius: 20px;
    border-bottom-right-radius: 0px;
    box-shadow: 1px 6px 50px 15px #808080ad;
  }
}
</style>
<style>
.vpd-icon-btn {
  background-color: rgb(101 101 101) !important;
}
</style>
