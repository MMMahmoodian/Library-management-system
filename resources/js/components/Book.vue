<template>
  <div class="book">
    <div class="container-fluid">
      <p v-show="!is_editing">
        
        Title : {{ book.title }}<br />
        Author : {{ book.authors[0].first_name }}
        {{ book.authors[0].last_name }}
        <br />
        ISBN : {{ book.isbn }}<br />
        Summary : {{ book.synopsis }}<br />
        Publisher : {{ book.publisher.name }}<br />
        Category : {{book.category.name}}<br />
        <button class="edit" v-show="!is_editing" v-on:click="editBook_true">
          E
        </button>
      </p>

      <div v-show="is_editing">
        Title :
        <b-form-input
          id="input-title"
          v-model="book.title"
          :state="nameState_T"
          aria-describedby="input-live-help input-live-feedback"
          placeholder="عنوان کتاب"
          trim
        ></b-form-input>

        نویسنده<b-form-select v-model="selected_auth" :options="authorsOptions">
        </b-form-select>

        ISBN :
        <b-form-input
          id="input-title"
          v-model="book.isbn"
          :state="nameState_I"
          aria-describedby="input-live-help input-live-feedback"
          placeholder="شابک"
          trim
        ></b-form-input>

        Summary :
        <b-form-input
          id="input-synopsis"
          v-model="book.synopsis"
          :state="nameState_S"
          aria-describedby="input-live-help input-live-feedback"
          placeholder="خلاصه"
          trim
        ></b-form-input>

        Publisher :
        <b-form-select v-model="selected_pub" :options="publishersOptions">
        </b-form-select>


        Category :
        <b-form-select v-model="selected_cat" :options="categoryOptions">
        </b-form-select>
      </div>

      <button @click="save" v-if="is_editing">Save</button>
      <button @click="$emit('del-book', book.id)" class="del" v-if="is_editing">
        DEL
      </button>
      <button class="edit_on" v-on:click="editBook_false" v-show="is_editing">
        Cancel
      </button>
    </div>
  </div>
</template>


<script>
export default {
  name: "Book",
  props: ["book", "categoryOptions", "publishersOptions", "authorsOptions"],
  computed: {
    nameState_T() {
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
    editBook_true: function () {
      this.is_editing = true;
    },
    editBook_false: function () {
      this.is_editing = false;
    },
    save() {
      console.log(this.selected_pub);
      console.log(this.selected_cat);
      axios
        .post("http://localhost:8000/api/management/book/edit", {
          
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
.book {
  opacity: 0.95;
  padding: 0px;
  margin: 0px;
  color: floralwhite;
  background: dimgray;
  padding: 10px;
  border-bottom: 1px #ccc dotted;
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