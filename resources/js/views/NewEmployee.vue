<template>
  <div class="container-fluid employee-container">
    <div class="row mt-4">
      <div class="col-lg-2 col-5">
        <b-button class="btn btn-light d-flex new-employee-btn" v-b-modal.modal-1
          >کارمند جدید</b-button
        >
      </div>

      <b-modal id="modal-1" title="اضافه کردن کارمند" hide-footer>
        <div class="container-fluid p-0 d-flex justify-content-center">
          <b-form class="row col-12 p-0">
            <b-form-group class="col-lg-6" id="input-group-1" label-for="input-1">
              <b-form-input
                id="input-1"
                type="text"
                required
                placeholder="نام کاربری"
              ></b-form-input>
            </b-form-group>
            <b-form-group class="col-lg-6" id="input-group-2" label-for="input-2">
              <b-form-input
                id="input-2"
                type="text"
                required
                placeholder="کد ملی"
              ></b-form-input>
            </b-form-group>
            <b-form-group class="col-lg-12" id="input-group-3" label-for="input-3">
              <b-form-input
                id="input-3"
                type="text"
                required
                placeholder="رمز عبور"
              ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-10" class="col-lg-12" label-for="input-10">
              <b-form-select v-model="selected" id="input-9" required>
                <option>وضعیت</option>
                <option>فعال</option>
                <option>غیرفعال</option>
              </b-form-select>
            </b-form-group>
            <div class="d-flex justify-content-center col-12">
              <b-button type="submit" class="btn new-employee">اضافه کردن</b-button>
            </div>
          </b-form>
        </div>
      </b-modal>
      <div class="header col-lg-8 col-7">
        <h4>لیست کارمندان</h4>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      selected: "وضعیت",
    };
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
