<template>
  <div id="booksdiv">
    <div v-bind:key="book.id" v-for="book in booksArr">
      <Book v-bind:book="book" v-on:del-book="$emit('del-book', book.id)" />
    </div>
  </div>
</template>

<script>
import Book from "./Book.vue";

export default {
  name: "Books",
  props: ["booksArr"],
  components: {
    Book,
  },
};
</script>

<style>
</style>