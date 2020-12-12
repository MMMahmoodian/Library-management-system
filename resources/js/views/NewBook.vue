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
          <b-form @submit="submitBook" class="row col-12 p-0">
            <b-form-group
              class="col-lg-6"
              id="input-group-1"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="title"
                :state="nameState_T"
                aria-describedby="input-live-help input-live-feedback"
                placeholder="عنوان کتاب"
                trim
              ></b-form-input>
            </b-form-group>

            <b-form-group
              class="col-lg-6"
              id="input-group-2"
              label-for="input-2"
            >
              نویسنده<b-form-select
                v-model="selected_auth"
                :options="authorsOptions"
              >
              </b-form-select>

              ناشر<b-form-select
                v-model="selected_pub"
                :options="publishersOptions"
              >
              </b-form-select>
            </b-form-group>

            <b-form-group
              class="col-lg-12"
              id="input-group-3"
              label-for="input-3"
            >
              <b-form-input
                id="input-3"
                v-model="isbn"
                :state="nameState_I"
                aria-describedby="input-live-help input-live-feedback"
                placeholder="کد شابک"
                trim
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
              دسته بندی<b-form-select
                v-model="selected_cat"
                :options="categoryOptions"
              >
              </b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-11"
              class="col-lg-12"
              label-for="input-11"
            >
              <b-form-textarea
                v-model="summary"
                :state="nameState_S"
                aria-describedby="input-live-help input-live-feedback"
                placeholder="خلاصه "
                rows="3"
              ></b-form-textarea>
            </b-form-group>
            <div class="d-flex justify-content-center col-12">
              <b-button type="submit"  class="btn new-book"
                >اضافه کردن</b-button
              >
            </div>
          </b-form>
        </div>
      </b-modal>
      
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

  computed: {
    nameState_T() {
      return this.title.length > 0 ? true : false;
    },
    nameState_I() {
      return this.isbn.length > 0 ? true : false;
    },
    nameState_S() {
      return this.summary.length > 0 ? true : false;
    },
  },
  created() {
    this.fetchArrays();
  },
  methods: {
    submitBook: function () {
      axios
        .post("http://localhost:8000/api/management/book/add", {
          title: this.title,
          synopsis: this.summary, 
          publisher_id: this.selected_pub,
          category_id: this.selected_cat,
          author_id: this.selected_auth,
          isbn: this.isbn,
        })
        .then(function (response) {
          console.log(response);
          if(response.data.message == "Bad request!"){
            alert(response.data.data.error);
          } else {
            alert("Book added");
            vm.$forceUpdate();//location.relode()'
          }
        })
        .catch(function (error) {
          console.log(error);
        });

    },

    fetchArrays: function () {
      var self = this;
      axios
        .get("http://localhost:8000/api/management/author/list")
        .then(function (response) {
          self.authorsArray = response.data.data;
          console.log(self.authorsArray);
          self.authorsArray.forEach((element) => {
            self.authorsOptions.push({
              text: element.first_name + " " + element.last_name,
              value: element.id,
            });
          });
        })
        .catch(function (error) {
          console.log(error);
        });

      axios
        .get("http://localhost:8000/api/management/publisher/list")
        .then(function (response) {
          self.publishersArray = response.data.data;
          console.log(self.publishersArray);
          self.publishersArray.forEach((element) => {
            self.publishersOptions.push({
              text: element.name,
              value: element.id,
            });
          });
        })
        .catch(function (error) {
          console.log(error);
        });

      axios
        .get("http://localhost:8000/api/management/category/list")
        .then(function (response) {
          self.categoryArray = response.data.data;
          console.log(self.categoryArray);
          self.categoryArray.forEach((element) => {
            self.categoryOptions.push({
              text: element.name,
              value: element.id,
            });
          });
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  data() {
    return {
      title: "",
      isbn: "",
      summary: "",
      authorsArray: null,
      publishersArray: null,
      categoryArray: null,
      selected_auth: null,
      selected_pub: null,
      selected_cat: null,
      authorsOptions: [],
      publishersOptions: [],
      categoryOptions: [],
      showAddNewBook: false,
      date: ""
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
