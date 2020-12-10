<template>
  <div class="book">
    <p v-show="!is_editing">
      Title : {{ book.title }}<br />
      Author : {{ book.authors[0].first_name }} {{ book.authors[0].last_name }}
      <br />
      ISBN : {{ book.isbn }}<br />
      Summary : {{ book.synopsis }}<br />
      Publisher : {{ book.publisher.name }}<br />
      <!-- Is Avaiable : {{ book.available }} -->
      <button class="edit" v-show="!is_editing" v-on:click="editBook_true">
        E
      </button>
    </p>

    <div v-show="is_editing">
      Title :<input
        type="text"
        ref="title"
        :value="book.title"
        :class="{ view: !is_editing }"
      /><br />

      Author's First Name :<input
        type="text"
        ref="Author_F"
        :value="book.authors[0].last_name"
        :class="{ view: !is_editing }"
      /><br />

      Author's Last Name :<input
        type="text"
        ref="Author_L"
        :value="book.authors[0].first_name"
        :class="{ view: !is_editing }"
      /><br />

      ISBN :<input
        type="text"
        ref="ISBN"
        :value="book.isbn"
        :class="{ view: !is_editing }"
      /><br />

      Summary :<input
        type="text"
        ref="synopsis"
        :value="book.synopsis"
        :class="{ view: !is_editing }"
      /><br />

      Publisher :<input
        type="text"
        ref="Publisher"
        :value="book.publisher.name"
        :disabled="!is_editing"
        :class="{ view: !is_editing }"
      /><br />
    </div>

    <button @click="save" v-if="is_editing">Save</button>
    <button @click="$emit('del-book', book.id)" class="del" v-if="is_editing">
      DEL
    </button>
    <button class="edit_on" v-on:click="editBook_false" v-show="is_editing">
      Cancel
    </button>
  </div>
</template>


<script>
export default {
  name: "Book",
  props: ["book"],
  methods: {
    editBook_true: function () {
      this.is_editing = true;
    },
    editBook_false: function () {
      this.is_editing = false;
    },
    save() {
      this.book.title = this.$refs["title"].value;
      this.book.Author = this.$refs["Author"].value;
      this.book.PubYear = this.$refs["PubYear"].value;
      this.book.circulation = this.$refs["circulation"].value;
      this.book.available = this.$refs["available"].value;
      this.is_editing = !this.is_editing;
      // axios
      //   .post("http://localhost:8000/api/management/book/edit", {

      //   })
      //   .then(function (response) {
      //     console.log(response);
      //   })
      //   .catch(function (error) {
      //     console.log(error);
      //   });

      axios
        .post("/user", {
          firstName: "Fred",
          lastName: "Flintstone",
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