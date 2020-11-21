<template>
  <div id="app">
    <button type="button" class="btn" @click="showModal">Open Modal!</button>

    <modal v-show="isModalVisible" @close="closeModal" />
  </div>
</template>

<script>
import modal from "../components/modal.vue";

export default {
  name: "app",
  components: {
    modal,
  },
  data() {
    return {
      isModalVisible: false,
    };
  },
  methods: {
    showModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
  },
};
</script>
