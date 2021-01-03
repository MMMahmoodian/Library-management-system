<template>
  <div id="Staffs_div">
    <b-card-group v-bind:key="staff.id" v-for="staff in StaffsArr">
      <Staff
        v-bind:staff="staff"
        v-on:del-staff="$emit('del-staff', staff.id)"
      />
    </b-card-group>
  </div>
</template>

<script>
import Staff from "./Staff.vue";

export default {
  name: "Staffs",
  created() {},
  props: ["StaffsArr"],
  components: {
    Staff,
  },
};
</script>

<style>
</style>