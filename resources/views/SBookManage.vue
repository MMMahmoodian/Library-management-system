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
  methods: {
    deleteBook(id) {
      console.log("deleting book " + id);
      //this.booksArray.splice(this.booksArray.indexOf(id), 1);
      this.booksArray = this.booksArray.filter((book) => book.id !== id);
    },
  },
  data() {
    return {
      booksArray: [
        {
          id: 1,
          title: "Book Number One",
          Author: "Folane Folani",
          PubYear: 1998,
          circulation: 10000, //tirazh
          available: true,
          edit: false,
        },
        {
          id: 2,
          title: "Book Number Two",
          Author: "Folane Mohammadi",
          PubYear: 1945,
          circulation: 100000, //tirazh
          available: true,
          edit: false,
        },
        {
          id: 3,
          title: "Book Number Three",
          Author: "Folane Folani",
          PubYear: 2002,
          circulation: 5000, //tirazh
          available: false,
          edit: false,
        },
        {
          id: 4,
          title: "Book Number Four",
          Author: "Mohammad Folani",
          PubYear: 2015,
          circulation: 2000, //tirazh
          available: true,
          edit: false,
        },
      ],
    };
  },
};
</script>

<style scoped>
</style>