<template>
  <div class="book">
    <p v-show="!book.edit">
      Title : {{ book.title }}<br />
      Author : {{ book.Author }}<br />
      Originally published : {{ book.PubYear }}<br />
      Circulation : {{ book.circulation }}<br />
      Is Avaiable : {{ book.available }}
      <button class="edit" v-show="!book.edit" v-on:click="editBook_true">
        E
      </button>
    </p>

    <div v-show="book.edit">
      Title :<input
        type="text"
        ref="title"
        :value="book.title"
        :class="{ view: !book.edit }"
      /><br />

      Author :<input
        type="text"
        ref="Author"
        :value="book.Author"
        :class="{ view: !book.edit }"
      /><br />

      Originally published :<input
        type="text"
        ref="PubYear"
        :value="book.PubYear"
        :class="{ view: !book.edit }"
      /><br />

      Circulation :<input
        type="text"
        ref="circulation"
        :value="book.circulation"
        :class="{ view: !book.edit }"
      /><br />

      available :<input
        type="text"
        ref="available"
        :value="book.available"
        :disabled="!book.edit"
        :class="{ view: !book.edit }"
      /><br />
    </div>

    <button @click="save" v-if="book.edit">Save</button>
    <button @click="$emit('del-book', book.id)" class="del" v-if="book.edit">DEL</button>
    <button class="edit_on" v-on:click="editBook_false" v-show="book.edit">
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
      this.book.edit = true;
    },
    editBook_false: function () {
      this.book.edit = false;
    },
    save() {
      this.book.title = this.$refs["title"].value;
      this.book.Author = this.$refs["Author"].value;
      this.book.PubYear = this.$refs["PubYear"].value;
      this.book.circulation = this.$refs["circulation"].value;
      this.book.available = this.$refs["available"].value;
      this.book.edit = !this.book.edit;
    },
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