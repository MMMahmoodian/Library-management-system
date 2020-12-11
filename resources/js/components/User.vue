<template>
  <div class="user">
    <!-- <p v-show="this.isAdm" class="gradient-box">HI ADMIN :)</p> -->
    <td>{{ user.FirstName }}</td>
    <td>{{ user.LastName }}</td>
    <td>{{ user.Phone }}</td>
    <td>{{ user.Email }}</td>
    <td>{{ user.PostalCode }}</td>
    <td>{{ user.NationalCode }}</td>
    <td>{{ user.UserName }}</td>
    <td>{{ user.Password }}</td>
    <td>{{ user.Active == false ? "غیرفعال" : "فعال" }}</td>
    <td>
      {{ user.isVerified == false ? "تایید نشده" : "تایید شده" }}
      <svg
        v-show="user.isVerified"
        xmlns="http://www.w3.org/2000/svg"
        x="0px"
        y="0px"
        width="24"
        height="24"
        viewBox="0 0 172 172"
        style=" fill:#000000;"
      >
        <g
          fill="none"
          fill-rule="nonzero"
          stroke="none"
          stroke-width="1"
          stroke-linecap="butt"
          stroke-linejoin="miter"
          stroke-miterlimit="10"
          stroke-dasharray=""
          stroke-dashoffset="0"
          font-family="none"
          font-weight="none"
          font-size="none"
          text-anchor="none"
          style="mix-blend-mode: normal"
        >
          <path d="M0,172v-172h172v172z" fill="none"></path>
          <g fill="#19e03d">
            <path
              d="M86,7.16667c-43.44792,0 -78.83333,35.38542 -78.83333,78.83333c0,43.44792 35.38542,78.83333 78.83333,78.83333c43.44792,0 78.83333,-35.38542 78.83333,-78.83333c0,-43.44792 -35.38542,-78.83333 -78.83333,-78.83333zM86,21.5c35.69336,0 64.5,28.80664 64.5,64.5c0,35.69336 -28.80664,64.5 -64.5,64.5c-35.69336,0 -64.5,-28.80664 -64.5,-64.5c0,-35.69336 28.80664,-64.5 64.5,-64.5zM124.74479,58.67708l-45.91146,45.6875l-23.51563,-23.51562l-10.30208,10.30208l28.66667,28.66667l5.15104,4.92708l5.15104,-4.92708l50.83854,-51.0625z"
            ></path>
          </g>
        </g>
      </svg>
    </td>
    <td v-show="!user.edit" v-on:click="verify">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        x="0px"
        y="0px"
        width="30"
        height="30"
        viewBox="0 0 172 172"
        style=" fill:#000000;"
      >
        <g
          fill="none"
          fill-rule="nonzero"
          stroke="none"
          stroke-width="1"
          stroke-linecap="butt"
          stroke-linejoin="miter"
          stroke-miterlimit="10"
          stroke-dasharray=""
          stroke-dashoffset="0"
          font-family="none"
          font-weight="none"
          font-size="none"
          text-anchor="none"
          style="mix-blend-mode: normal"
        >
          <path d="M0,172v-172h172v172z" fill="none"></path>
          <g>
            <path
              d="M157.66667,86c0,-10.42392 -5.92325,-19.522 -14.56983,-24.11583c2.36142,-8.99775 0.06092,-19.00242 -6.96242,-26.02217c-5.24242,-5.246 -12.15108,-7.85467 -19.06692,-7.85467c-2.33992,0 -4.67983,0.29742 -6.95525,0.89583c-4.59025,-8.64658 -13.68833,-14.56983 -24.11225,-14.56983c-10.42392,0 -19.522,5.92325 -24.11583,14.56983c-2.279,-0.59842 -4.61533,-0.89583 -6.95525,-0.89583c-6.91583,0 -13.82092,2.61225 -19.06692,7.85467c-7.01975,7.01975 -9.32383,17.02083 -6.96242,26.02217c-8.643,4.59383 -14.56625,13.69192 -14.56625,24.11583c0,10.42392 5.92325,19.522 14.56983,24.11583c-2.36142,8.99775 -0.06092,19.00242 6.96242,26.02217c5.24242,5.24242 12.15108,7.85467 19.06692,7.85467c2.33992,0 4.67983,-0.29742 6.95525,-0.89583c4.59025,8.64658 13.68833,14.56983 24.11225,14.56983c10.42392,0 19.522,-5.92325 24.11583,-14.56983c2.279,0.59842 4.61533,0.89583 6.95525,0.89583c6.91583,0 13.82092,-2.61225 19.06692,-7.85467c7.01975,-7.01975 9.32383,-17.02083 6.96242,-26.02217c8.643,-4.59383 14.56625,-13.69192 14.56625,-24.11583z"
              fill="#4caf50"
            ></path>
            <path
              d="M78.83333,117.63725l-26.56683,-26.57042l10.13367,-10.13367l16.43317,16.42958l34.34983,-34.34625l10.13367,10.13367z"
              fill="#ffffff"
            ></path>
          </g>
        </g>
      </svg>
    </td>
    <td v-b-modal.modal-1>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        x="0px"
        y="0px"
        width="24"
        height="24"
        viewBox="0 0 172 172"
        style=" fill:#000000;"
      >
        <g
          fill="none"
          fill-rule="nonzero"
          stroke="none"
          stroke-width="1"
          stroke-linecap="butt"
          stroke-linejoin="miter"
          stroke-miterlimit="10"
          stroke-dasharray=""
          stroke-dashoffset="0"
          font-family="none"
          font-weight="none"
          font-size="none"
          text-anchor="none"
          style="mix-blend-mode: normal"
        >
          <path d="M0,172v-172h172v172z" fill="none"></path>
          <g fill="#000000">
            <path
              d="M129,14.33333l-17.30078,17.30078l28.66667,28.66667l17.30078,-17.30078zM100.87923,42.4541l-79.37923,79.37923v28.66667h28.66667l79.37923,-79.37923z"
            ></path>
          </g>
        </g>
      </svg>
    </td>
    <b-modal id="modal-1" title="ویرایش" hide-footer>
      <div class="container-fluid p-0 d-flex justify-content-center">
        <b-form class="row col-12 p-0">
          <b-form-group class="col-lg-6" id="input-group-1" label-for="input-1">
            <b-form-input
              id="input-1"
              type="text"
              :value="user.FirstName"
              ref="FirstName"
              required
              placeholder="نام"
            ></b-form-input>
          </b-form-group>
          <b-form-group class="col-lg-6" id="input-group-2" label-for="input-2">
            <b-form-input
              id="input-2"
              type="text"
              required
               ref="LastName"
              :value="user.LastName"
              placeholder="نام خانوادگی"
            ></b-form-input>
          </b-form-group>
          <b-form-group class="col-lg-6" id="input-group-1" label-for="input-1">
            <b-form-input
              id="input-1"
              type="text"
              required
               ref="Phone"
              :value="user.Phone"
              placeholder="تلفن"
            ></b-form-input>
          </b-form-group>
          <b-form-group class="col-lg-6" id="input-group-3" label-for="input-3">
            <b-form-input
              id="input-3"
              type="text"
              required
               ref="Password"
              :value="user.Password"
              placeholder="رمز عبور"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            class="col-lg-12"
            id="input-group-3"
            label-for="input-3"
          >
            <b-form-input
              id="input-3"
              type="text"
              required
               ref="NationalCode"
              :value="user.NationalCode"
              placeholder=" کد ملی"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            class="col-lg-12"
            id="input-group-3"
            label-for="input-3"
          >
            <b-form-input
              id="input-3"
              type="text"
              required
               ref="PostalCode"
              :value="user.PostalCode"
              placeholder=" کد پستی"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            class="col-lg-12"
            id="input-group-3"
            label-for="input-3"
          >
            <b-form-input
              id="input-3"
              type="text"
              required
               ref="email"
              :value="user.Email"
              placeholder=" ایمیل"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            class="col-lg-12"
            id="input-group-3"
            label-for="input-3"
          >
            <b-form-input
              id="input-3"
              type="text"
              required
               ref="UserName"
              :value="user.UserName"
              placeholder=" نام کاربری"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            id="input-group-10"
            class="col-lg-12"
            label-for="input-10"
          >
            <b-form-select
              v-model="selected"
              id="input-9"
              required
               ref="Active"
              :value="user.Active"
            >
              <option>وضعیت</option>
              <option>فعال</option>
              <option>غیرفعال</option>
            </b-form-select>
          </b-form-group>
          <div class="d-flex justify-content-center col-12">
            <b-button type="submit" class="btn new-employee" @click="save"> ویرایش</b-button>
          </div>
        </b-form>
      </div>
    </b-modal>
   
  </div>
</template>

<script>
export default {
  name: "user",
  props: ["user", "isAdm"],
  methods: {
    edit_true: function () {
      console.log(this.isAdm);
      this.user.edit = true;
    },
    edit_false: function () {
      this.user.edit = false;
    },
    save() {
      this.user.FirstName = this.$refs["FirstName"].value;
      this.user.LastName = this.$refs["LastName"].value;
      this.user.Phone = this.$refs["Phone"].value;
      this.user.Email = this.$refs["Email"].value;
      this.user.PostalCode = this.$refs["PostalCode"].value;
      this.user.NationalCode = this.$refs["NationalCode"].value;
      this.user.UserName = this.$refs["UserName"].value;
      this.user.Password = this.$refs["Password"].value;
      this.user.Active = this.$refs["Active"].value;
      this.user.edit = !this.user.edit;
    },
    verify: function () {
      this.user.isVerified = !this.user.isVerified;
    },
  },
};
</script>

<style scoped>
.user {
  display: contents;
}
</style>