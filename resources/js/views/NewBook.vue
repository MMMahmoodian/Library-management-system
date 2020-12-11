<template>
  <div class="container-fluid book-container">
    <div class="row mt-4">
      <div class="col-lg-2 col-5">
        <b-button class="btn btn-light d-flex new-book-btn" v-b-modal.modal-1
          >کتاب جدید</b-button
        >
      </div>

      <b-modal id="modal-1" title="اضافه کردن کتاب" hide-footer>
        <div class="container-fluid p-0 d-flex justify-content-center">
          <b-form class="row col-12 p-0">
            <b-form-group
              class="col-lg-6"
              id="input-group-1"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                type="text"
                required
                placeholder="عنوان"
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
                required
                placeholder="نویسنده"
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
                placeholder="کد شابک"
              ></b-form-input>
            </b-form-group>
            <b-form-group class="col-6">
              <div>
                <small class="d-flex mb-1">تاریخ انتشار :</small>
                <date-picker v-model="date"></date-picker>
              </div>
            </b-form-group>
             <b-form-group
              id="input-group-10"
              class="col-6 mt-auto"
              label-for="input-10"
            >
              <b-form-select v-model="selected" id="input-9" required>
                <option>دسته بندی</option>
                <option>سیاسی</option>
                <option>اقتصاد</option>
              </b-form-select>
            </b-form-group>
            <b-form-group
              id="input-group-10"
              class="col-lg-12"
              label-for="input-10"
            >
              <b-form-textarea
                id="textarea-rows"
                placeholder="نظر ناشر"
                rows="3"
              ></b-form-textarea>
            </b-form-group>
            <div class="d-flex justify-content-center col-12">
              <b-button type="submit" class="btn new-book">اضافه کردن</b-button>
            </div>
          </b-form>
        </div>
      </b-modal>
      <div class="header col-lg-8 col-7">
        <h4>لیست کتاب ها</h4>
      </div>
    </div>
    <table class="table mt-2">
      <thead class="thead-dark">
        <tr>
          <th scope="col">شناسه</th>
          <th scope="col">عنوان</th>
          <th scope="col">کد شابک</th>
          <th scope="col">شناسه نویسنده</th>
          <th scope="col">تاریخ انتشار</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>بیشعوری</td>
          <td>187890</td>
          <td>1</td>
          <td>2020</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>مردی در جاده</td>
          <td>217840</td>
          <td>2</td>
          <td>2019</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>1984</td>
          <td>123490</td>
          <td>3</td>
          <td>2018</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>2بیشعوری</td>
          <td>187890</td>
          <td>1</td>
          <td>2020</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      showAddNewBook: false,
      date: "",
      selected:'دسته بندی'
    };
  },
};
</script>
<style scoped>
.book-container {
  padding: 96px;
}
.new-book-btn {
  background-color: #1f369a;
  color: white;
}
.new-book-btn:hover {
  background-color: #1c5ee4;
  color: white;
}
form {
  direction: rtl;
}
.new-book {
  background-color: #133ef7;
}
.new-book:hover {
  background-color: #1c0097 !important;
}
@media screen and (max-width: 700px) {
  .book-container {
    padding: 0;
  }
}
.header h4 {
  font-weight: 800;
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
