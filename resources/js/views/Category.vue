<template>
  <div class="container-fluid employee-container">
    <div class="row mt-4">
      <div class="col-lg-2 col-5">
        <b-button
          class="btn btn-light d-flex new-employee-btn"
          v-b-modal.modal-1
          >دسته بندی جدید</b-button
        >
      </div>

      <b-modal id="modal-1" title="اضافه کردن دسته بندی" hide-footer>
        <div class="container-fluid p-0 d-flex justify-content-center">
          <b-form class="row col-12 p-0 d-flex justify-content-center">
            <b-form-group
              class="col-lg-9"
              id="input-group-1"
              label-for="input-1"
            >
              <b-form-input
                id="input-3"
                v-model="name"
                aria-describedby="input-live-help input-live-feedback"
                placeholder="نام"
              ></b-form-input>
            </b-form-group>

            <div class="d-flex justify-content-center col-lg-12">
              <b-button v-on:click="submitCategory" class="btn new-employee"
                >اضافه کردن</b-button
              >
            </div>
          </b-form>
        </div>
      </b-modal>

      <div class="header col-lg-8 col-7">
        <h4>لیست دسته بندی ها</h4>
      </div>
    </div>
    <b-modal id="modal-2" title="حذف دسته بندی" hide-footer>
      <div>
        <p class="delete-text">این دسته بندی حذف شود؟</p>
      </div>
      <div>
        <button class="btn btn-danger">حذف</button>
        <button class="btn btn-info ml-1">انصراف</button>
      </div>
      <div></div>
      <div></div>
    </b-modal>

    <table class="table mt-4">
      <thead class="thead-dark">
        <tr>
          <th scope="col">شناسه</th>
          <th scope="col">نام</th>
        </tr>
      </thead>
      <tbody>
        <tr v-bind:key="cat.id" v-for="cat in categoryArray">
          <th scope="row">{{ cat.id }}</th>
          <td>{{ cat.name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: "",
      selected: "وضعیت",
      categoryArray: [],
    };
  },
  methods: {
    fetchArrays: function () {
      var self = this;
      axios
        .get("/api/management/category/list")
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
    submitCategory: function () {
      var self = this;
      axios
        .post("/api/management/category/add", {
          name: this.name,
        })
        .then(function (response) {
          console.log(response);
          if (response.data.message != "Bad request!") {
            alert("دسته بندی با موفقیت ساخته شد");
          } else {
            alert("نام دسته بندی را مشخص کنید");
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },

  created() {
    this.fetchArrays();
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
.delete-text {
  display: flex;
  justify-content: flex-end;
}
</style>
<style>
.modal-title {
  display: flex;
  justify-content: center;
  width: -webkit-fill-available;
}
</style>
