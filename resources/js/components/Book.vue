<template>
  <div class="book">
      <b-card img-alt="Card image" img-right class="mb-3">
          <b-card-title>{{ book.title }}</b-card-title>
          <b-card-text class="disable_this">
              This is a wider card with supporting text below as a natural lead-in to
              additional content. This content is a little bit Lorem ipsum dolor sit
              amet consectetur adipisicing elit.
          </b-card-text>

          <b-list-group flush v-if="!is_editing">
              <b-list-group-item> Author : {{ book.authors[0].first_name }}
                  {{ book.authors[0].last_name }} </b-list-group-item>
              <b-list-group-item>Isbn : {{ book.isbn }}</b-list-group-item>
              <b-list-group-item
              >Summary : {{ book.synopsis }}</b-list-group-item
              >
              <b-list-group-item
              > Category : {{ book.category.name }}</b-list-group-item
              >
          </b-list-group>

          <b-form @submit="save" v-if="is_editing">
              <b-form-group id="input-group-1" label="Title" label-for="input-1">
                  <b-form-input
                      id="input-1"
                      v-model="book.title"
                      placeholder="book.title"
                      required
                  ></b-form-input>
              </b-form-group>

              <b-form-group
                  id="input-group-2"
                  label="Author "
                  label-for="input-2"
              >
                  <b-form-select
                      :disabled="false"
                      v-model="selected_auth"
                      :options="authorsOptions"
                  >
                  </b-form-select>
              </b-form-group>

              <b-form-group id="input-group-3" label="ISBN" label-for="input-3">
                  <b-form-input
                      id="input-title"
                      v-model="book.isbn"
                      :state="nameState_I"
                      aria-describedby="input-live-help input-live-feedback"
                      placeholder="ISBN"
                      trim
                  ></b-form-input>
              </b-form-group>

              <b-form-group
                  id="input-group-4"
                  label="Summary"
                  label-for="input-4"
              >
                  <b-form-input
                      id="input-synopsis"
                      v-model="book.synopsis"
                      :state="nameState_S"
                      aria-describedby="input-live-help input-live-feedback"
                      placeholder="Summary"
                      trim
                  ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-5" label="Publisher" label-for="input-5">
                  <b-form-select v-model="selected_pub" :options="publishersOptions">
                  </b-form-select>
              </b-form-group>

              <b-form-group id="input-group-6" label="Category" label-for="input-6">
                  <b-form-select v-model="selected_cat" :options="categoryOptions">
                  </b-form-select>
              </b-form-group>

              <b-button type="submit" variant="primary">ثبت</b-button>
              <b-button @click="edit_false" variant="danger">خروج</b-button>
          </b-form>

          <template #footer>
              <b-button variant="primary" class="btn d-flex" @click="edit_toggle"
              >ادیت</b-button
              >
              <b-button
                  variant="danger"
                  class="btn d-flex"
                  @click="deletethis"
              >
                  حذف
              </b-button>
          </template>
      </b-card>
  </div>
</template>


<script>
export default {
  name: "Book",
  props: ["book", "categoryOptions", "publishersOptions", "authorsOptions"],
  computed: {
    nameState_T(input) {
      return this.book.title.length > 0 ? true : false;
    },
    nameState_I() {
      return this.book.isbn.length > 0 ? true : false;
    },
    nameState_S() {
      return this.book.synopsis.length > 0 ? true : false;
    },
  },
  methods: {
      deletethis: function () {
          this.$emit("del-staff", this.staff.id);
      },
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
    editBook_true: function () {
      this.is_editing = true;
    },
    editBook_false: function () {
      this.is_editing = false;
    },
    save() {
      axios
        .post("/api/management/book/edit", {
          book_id: this.book.id,
          title: this.book.title,
          synopsis: this.book.summary,
          publisher_id: this.selected_pub,
          category_id: this.selected_cat,
          author_id: this.selected_auth,
          isbn: this.book.isbn,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  data() {
    return {
      is_editing: false,
      selected_auth: null,
      selected_pub: null,
      selected_cat: null,
    };
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
