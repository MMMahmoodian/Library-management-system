<template>
  <div id="sbm">
    <Books v-bind:booksArr="booksArray" v-on:del-book="deleteBook" />
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
  },
  
  methods: {
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
    };
  },
};
</script>

<style scoped></style>
