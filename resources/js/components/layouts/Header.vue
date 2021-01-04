<template>
  <div id="booksdiv">
    <div>
      <b-navbar toggleable="sm" type="light" variant="light">
        <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>
        <img
          src="../../assets/pics/librarylogo.png"
          width="65px"
          height="65px"
          alt="logo"
        />

        <b-navbar-brand class="m-0">سامانه مدیریت کتابخانه</b-navbar-brand>
        <div class="login-container">
          <b-button v-if="isLoggedIn" v-b-toggle.sidebar-no-header
            >پنل کاربری</b-button
          >
          <b-sidebar
            bg-variant="dark"
            id="sidebar-no-header"
            aria-labelledby="sidebar-no-header-title"
            no-header
            shadow="lg"
          >
            <template #default="{ hide }">
              <div class="p-3">
                <h5 class="text-white-50" id="sidebar-no-header-title">
                  کاربر {{ User }}
                </h5>

                <nav class="mb-3">
                  <b-nav vertical>
                    <b-nav-item active>
                    <router-link v-if="!isAdminOrStaff" to="/Profile">مشاهده پروفایل </router-link>
                    </b-nav-item>
                  </b-nav>
                </nav>
                <b-button v-if="isLoggedIn" block variant="danger"
                  ><a @click="logout"> خروج </a></b-button
                >
                <b-button variant="primary" block @click="hide">بستن</b-button>
              </div>
            </template>
          </b-sidebar>

          <button v-if="!isLoggedIn" class="btn btn-primary btn-login">
            <router-link to="/adminlogin">ورود ادمین </router-link>
          </button>
          <button v-if="!isLoggedIn" class="btn btn-primary btn-login">
            <router-link to="/stafflogin">ورود کارکنان </router-link>
          </button>
          <button v-if="!isLoggedIn" class="btn btn-primary btn-login">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              x="0px"
              y="0px"
              width="20"
              height="20"
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
                <g fill="#fff">
                  <path
                    d="M50.16667,35.83333c-27.70633,0 -50.16667,22.46033 -50.16667,50.16667c0,27.70633 22.46033,50.16667 50.16667,50.16667c22.72313,0 41.89756,-15.11458 48.06706,-35.83333h30.76628v21.5h28.66667v-21.5h14.33333v-28.66667h-73.76628c-6.1695,-20.71875 -25.34393,-35.83333 -48.06706,-35.83333zM50.16667,64.5c11.87517,0 21.5,9.62483 21.5,21.5c0,11.87517 -9.62483,21.5 -21.5,21.5c-11.87517,0 -21.5,-9.62483 -21.5,-21.5c0,-11.87517 9.62483,-21.5 21.5,-21.5z"
                  ></path>
                </g>
              </g>
            </svg>
            <router-link to="/login">ورود به سیستم </router-link>
          </button>
          <button v-if="!isLoggedIn" class="btn btn-info btn-register mr-1">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              x="0px"
              y="0px"
              width="20"
              height="20"
              viewBox="0 0 226 226"
              style="fill: #fff"
            >
              <g
                fill="none"
                fill-rule="none"
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
                <path
                  d="M0,226v-226h226v226z"
                  fill="none"
                  fill-rule="nonzero"
                ></path>
                <g fill="#fff" fill-rule="evenodd">
                  <path
                    d="M103.58333,18.83333v84.75h-84.75v18.83333h84.75v84.75h18.83333v-84.75h84.75v-18.83333h-84.75v-84.75z"
                  ></path>
                </g>
              </g>
            </svg>
            <router-link to="/Register"> ثبت نام </router-link>
          </button>
        </div>
        <b-collapse id="nav-text-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item>
              <router-link to="/About"> درباره ما </router-link></b-nav-item
            >
            <b-nav-item>
              <router-link v-if="isLoggedIn" to="/Category">
                دسته بندی
              </router-link></b-nav-item
            >
            <b-nav-item>
              <router-link v-if="isLoggedIn" to="/NewBook"
                >کتاب ها
              </router-link></b-nav-item
            >
            <b-nav-item>
              <router-link v-if="isAdmin" to="/NewEmployee">
                کارمند ها
              </router-link></b-nav-item
            >
            <b-nav-item>
              <router-link v-if="isAdmin" to="/AUserManage"
                >مدیریت کاربران
              </router-link></b-nav-item
            >
            <b-nav-item>
              <router-link v-if="isStaff" to="/StaffVerification">
                احراز هویت کاربران
              </router-link></b-nav-item
            >
            <b-nav-item>
              <router-link v-if="isAdminOrStaff" to="/SBookManage">
                مدیریت کتابها
              </router-link></b-nav-item
            >

            <b-nav-item>
              <router-link v-if="isAdminOrStaff" to="/Rented">
                قرض داده شده
              </router-link></b-nav-item
            >
          </b-navbar-nav>
            <b-nav-item>
                  <router-link to="/Authors">
                  نویسنده ها
                  </router-link>
            </b-nav-item>
        </b-collapse>
      </b-navbar>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Header",
  computed: {
    ...mapGetters({ User: "StateUser" }),
    isLoggedIn: function () {
      return this.$store.getters.isAuthenticated;
    },
    isAdmin: function () {
      return this.$store.getters.isAdmin;
    },
    isStaff: function () {
      return this.$store.getters.isStaff;
    },
    isAdminOrStaff: function () {
      return this.$store.getters.isStaff || this.$store.getters.isAdmin;
    },
  },
  methods: {
    async logout() {
      await this.$store.dispatch("LogOut");
      this.$router.push("/login");
    },
  },
};
</script>

<style>
.btn-login,
.btn-register {
  border-radius: 10px;
}
a {
  color: black !important;
  font-size: 15px;
}
.login-container {
  margin-right: 10%;
}
@media screen and (max-width: 600px) {
  .login-container {
    margin-right: 0%;
  }
}
.navbar {
  background-color: #a9a9a93b !important;
}
.home-img {
  filter: grayscale();
  width: 100%;
  height: 572px;
  border-radius: 7px;
}
.home-text {
  border: 0.5px solid #d0bebe;
  padding: 19px;
  border-radius: 4px;
  height: 95%;
  padding-top: 20%;
}
li {
      list-style-type: none;
}
li:hover {
  background: #d8d8d8;
  border-radius: 16px;
  transition: 1s;
}
.contact-us {
  background: #efefef;
}
</style>