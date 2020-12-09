<template>
  <div class="book">
    <p v-show="!is_editing">
      Title : {{ book.title }}<br />
      Created at : {{ book.created_at }}<br />
      ISBN : {{ book.isbn }}<br />
      Summary : {{ book.synopsis }}<br />
      Is Avaiable : {{ book.available }}
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

      Created at :<input
        type="text"
        ref="Author"
        :value="book.created_at"
        :class="{ view: !is_editing }"
      /><br />

      ISBN :<input
        type="text"
        ref="PubYear"
        :value="book.isbn"
        :class="{ view: !is_editing }"
      /><br />

      Summary :<input
        type="text"
        ref="circulation"
        :value="book.synopsis"
        :class="{ view: !is_editing }"
      /><br />

      Is Avaiable :<input
        type="text"
        ref="available"
        :value="book.available"
        :disabled="!is_editing"
        :class="{ view: !is_editing }"
      /><br />
    </div>

    <button @click="save" v-if="is_editing">Save</button>
    <button @click="$emit('del-book', book.id)" class="del" v-if="is_editing">DEL</button>
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
    },
  },
  data(){
    return{
      is_editing: false,
    };
  }
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