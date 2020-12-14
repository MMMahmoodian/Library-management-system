<template>
  <div id="Staffs_div">
    <div v-bind:key="staff.id" v-for="staff in StaffsArr">
      <Staff
        v-bind:staff="staff"
        v-on:del-staff="$emit('del-user', staff.id)"
        v-bind:isAdm="isAdm"
      />
    </div>
  </div>
</template>

<script>
import Staff from "./Staff.vue";

export default {
  name: "Staffs",
  created() {},
  props: ["StaffsArr", "isAdm"],
  components: {
    Staff,
  },
};
</script>

<style>
</style>