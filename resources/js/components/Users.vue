
<template>
  <div>
    <table class="table mt-4">
      <thead class="thead-dark">
        <tr>
          <th scope="col">نام</th>
          <th scope="col">نام خانوادگی</th>
          <th scope="col">تلفن</th>
          <th scope="col">ایمیل</th>
          <th scope="col">کد پستی</th>
          <th scope="col">کد ملی</th>
          <th scope="col">نام کاربری</th>
          <th scope="col">رمز عبور</th>
          <th scope="col">وضعیت</th>
          <th scope="col">احراز هویت</th>
          <th scope="col">تایید هویت</th>
          <th scope="col" v-if="UsersArr[0].edit">ویرایش</th>
        </tr>
      </thead>
      <tbody>
        <tr v-bind:key="user.id" v-for="user in UsersArr">
            <User v-bind:user="user" v-on:del-user="$emit('del-user', user.id)" v-bind:isAdm="isAdm" />
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import User from "./User.vue"

export default {
  name: "Users",
  props: ["UsersArr", "isAdm"],
  components:{
      User
  }
};
</script>

<style>
</style>