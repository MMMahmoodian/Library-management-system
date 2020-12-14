<template>
  <div id="booksdiv">
    <div v-bind:key="book.id" v-for="book in booksArr">
      <Book
        v-bind:book="book"
        v-bind:categoryOptions="categoryOptions"
        v-bind:publishersOptions="publishersOptions"
        v-bind:authorsOptions="authorsOptions"
        v-on:del-book="$emit('del-book', book.id)"
      />
    </div>
  </div>
</template>

<script>
import Book from "./Book.vue";

export default {
  name: "Books",
  props: ["booksArr", "categoryOptions", "publishersOptions", "authorsOptions"],
  components: {
    Book,
  },
};
</script>

<style>
</style>
