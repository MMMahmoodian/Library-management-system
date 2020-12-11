<template>
  <div id="sbm">
    <Books v-bind:booksArr="booksArray"
     v-bind:authorsOptions="authorsOptions"
     v-bind:publishersOptions="publishersOptions"
     v-bind:categoryOptions="categoryOptions"
     v-on:del-book="deleteBook" />
  </div>
</template>

<script>
import Books from "../components/Books";

export default {
  name: "SBookManage",
  components: {
    Books,
  },

  created() {
    this.fetchBooks();
    this.fetchArrays();
  },
  
  methods: {
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
    deleteBook(id) {
      console.log("deleting book " + id);
      this.booksArray = this.booksArray.filter((book) => book.id !== id);
    },
    fetchBooks: function () {
      var self = this;
      axios
        .get("http://localhost:8000/api/management/book/list")
        .then(function (response) {
          console.log(response);
          self.booksArray = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  mounted: function () {

  },
  data() {
    return {
      booksArray: null,
      authorsArray: null,
      publishersArray: null,
      categoryArray: null,
      authorsOptions: [],
      publishersOptions: [],
      categoryOptions: [],
    };
  },
};
</script>

<style scoped></style>
