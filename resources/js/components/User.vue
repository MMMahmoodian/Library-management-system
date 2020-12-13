<template>
  <div class="user">
    <!-- <p v-show="this.isAdm" class="gradient-box">HI ADMIN :)</p> -->

    نام:<td>{{ user.first_name }}</td>
    نام خانوادگی<td>{{ user.last_name }}</td>
    شماره تماس<td>{{ user.phone }}</td>
    پست الکترونیک<td>{{ user.email }}</td>
    شماره پستی<td>{{ user.postal_code }}</td>
    شماره ملی<td>{{ user.national_code }}</td>
    <!-- <td>{{ user.Active == false ? "غیرفعال" : "فعال" }}</td> -->

      {{ user.verified == false ? "تایید نشده" : "تایید شده" }}
      <svg
        v-show="user.isVerified"
        xmlns="http://www.w3.org/2000/svg"
        x="0px"
        y="0px"
        width="24"
        height="24"
        viewBox="0 0 172 172"
        style="fill: #000000"
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
        style="fill: #000000"
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
        style="fill: #000000"
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
              d="M129,14.33333l-17.30078,17.30078l28.66667,28.66667l17.30078,
              -17.30078zM100.87923,42.4541l-79.37923,79.37923v28.66667h28.66667l79.37923,-79.37923z"
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
              v-model="user.first_name"
              required
              aria-describedby="input-live-help input-live-feedback"
              placeholder="نام"
              :value="user.first_name"
            ></b-form-input>
          </b-form-group>
          <b-form-group class="col-lg-6" id="input-group-2" label-for="input-2">
            <b-form-input
              id="input-2"
              v-model="user.last_name"
              required
              aria-describedby="input-live-help input-live-feedback"
              placeholder="نام خانوادگی"
              :value="user.last_name"
            ></b-form-input>
          </b-form-group>
          <b-form-group class="col-lg-6" id="input-group-1" label-for="input-1">
            <b-form-input
              id="input-3"
              v-model="user.phone"
              required
              aria-describedby="input-live-help input-live-feedback"
              placeholder="نام خانوادگی"
              :value="user.phone"
              trim
            ></b-form-input>
          </b-form-group>

          <b-form-group
            class="col-lg-12"
            id="input-group-3"
            label-for="input-3"
          >
            <b-form-input
              id="input-national"
              v-model="user.national_code"
              type="text"
              required
              aria-describedby="input-live-help input-live-feedback"
              placeholder="کد ملی"
              :value="user.national_code"
              trim
            ></b-form-input>
          </b-form-group>
          <b-form-group
            class="col-lg-12"
            id="input-group-3"
            label-for="input-3"
          >
            <b-form-input
              id="input-postal"
              v-model="user.postal_code"
              required
              aria-describedby="input-live-help input-live-feedback"
              placeholder="کد پستی"
              :value="user.postal_code"
              trim
            ></b-form-input>
          </b-form-group>
          <b-form-group
            class="col-lg-12"
            id="input-group-3"
            label-for="input-3"
          >
            <b-form-input
              id="input-email"
              v-model="user.email"
              required
              aria-describedby="input-live-help input-live-feedback"
              placeholder="ایمیل"
              :value="user.email"
            ></b-form-input>
          </b-form-group>

          <div class="d-flex justify-content-center col-12">
            <b-button type="submit" class="btn new-employee" @click="save">
              ویرایش</b-button
            >
          </div>
        </b-form>
      </div>

    </b-modal>
  </div>
</template>

<script>
export default {
  name: "user",
  data() {
    return {
      is_editing: false,
    };
  },
  props: ["user", "isAdm"],

  methods: {
    edit_true: function () {
      console.log(this.isAdm);
      this.is_editing = true;
    },
    edit_false: function () {
      this.is_editing = false;
    },
    save() {
      var self = this;
      axios
        .post("/api/management/user/edit", {
          user_id: self.user.if,
          first_name: self.user.first_name,
          last_name: self.user.last_name,
          phone: self.user.phone,
          email: self.user.email,
          postal_code: self.user.postal_code,
          national_code: self.user.national_code,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    verify: function () {
      console.log(this.user.id);
      axios
        .post("/api/management/user/patron/verify", {
          user_id: this.user.id,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
.is-verified {
  border: 2px solid green;
}
.is-not-verified {
  border: 2px dotted red;
}

.user {
  opacity: 0.95;
  padding: 0px;
  margin: 0px;
  color: floralwhite;
  background: rgb(105, 46, 6);
  padding: 10px;
  border-bottom: 1px #ccc dotted;
  color: white;
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