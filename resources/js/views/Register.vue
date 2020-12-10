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
            <b-form-group class="col-lg-6" id="input-group-1" label-for="input-1">
              <b-form-input
                id="input-1"
                type="text"
                required
                placeholder="نام"
              ></b-form-input>
            </b-form-group>
            <b-form-group class="col-lg-6" id="input-group-2" label-for="input-2">
              <b-form-input
                id="input-2"
                type="text"
                required
                placeholder="نام خانوادگی"
              ></b-form-input>
            </b-form-group>
            <b-form-group class="col-lg-6" id="input-group-5" label-for="input-5">
              <b-form-input
                id="input-5"
                type="text"
                required
                placeholder="تلفن همراه"
              ></b-form-input>
            </b-form-group>

            <b-form-group class="col-lg-6" id="input-group-4" label-for="input-4">
              <b-form-input
                id="input-4"
                type="text"
                required
                placeholder="تلفن"
              ></b-form-input>
            </b-form-group>

            <b-form-group class="col-lg-12" id="input-group-3" label-for="input-3">
              <b-form-input
                id="input-3"
                type="text"
                required
                placeholder="کد ملی"
              ></b-form-input>
            </b-form-group>

            <b-form-group class="col-lg-12" id="input-group-6" label-for="input-6">
              <b-form-input
                id="input-6"
                type="email"
                required
                placeholder="پست الکترونیکی"
              ></b-form-input>
            </b-form-group>
            <b-form-group class="col-lg-12" id="input-group-7" label-for="input-7">
              <b-form-input
                id="input-7"
                type="text"
                required
                placeholder="کد پستی"
              ></b-form-input>
            </b-form-group>
            <b-form-group class="col-lg-5">
              <div>
                <small class="d-flex mb-1">تاریخ تولد :</small>
                <date-picker v-model="date"></date-picker>
              </div>
            </b-form-group>
            <b-form-group id="input-group-9" class="col-lg-4 mt-auto" label-for="input-9">
              <b-form-select v-model="selected" id="input-9" required>
                <option>جنسیت</option>
                <option>مرد</option>
                <option>زن</option>
              </b-form-select>
            </b-form-group>
            <b-form-group class="col-lg-3 mt-auto" id="input-group-8" label-for="input-8">
              <b-form-input
                id="input-8"
                type="text"
                required
                placeholder=" ملیت"
              ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-10" class="col-lg-12" label-for="input-10">
              <b-form-textarea
                id="textarea-rows"
                placeholder="آدرس"
                rows="3"
              ></b-form-textarea>
            </b-form-group>
            <div class="d-flex justify-content-center col-12">
              <b-button type="submit" class="btn btn-register">ثبت نام</b-button>
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
  data() {
    return {
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
