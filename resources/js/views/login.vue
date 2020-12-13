<template>
  <div>
    <div class="row col-lg-auto col-lg-auto login-row p-0">
      <div class="col-lg-6 p-0">
        <div>
          <div>
            <img
              src="../assets/pics/librarylogo.png"
              width="115px"
              height="115px"
              alt="logo"
            />
          </div>
          <h4 class="login-title">ورود</h4>
        </div>
        <div class="row p-3">
          <b-form class="row col-12 pl-0">
            <b-form-group
              class="col-lg-12"
              id="input-group-1"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                type="text"
                name="email"
                v-model="email"

                required
                placeholder="ایمیل"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              class="col-lg-12"
              id="input-group-2"
              label-for="input-2"
            >
              <b-form-input
                id="input-2"
                type="password"
                required
                name="password"
                v-model="password"
                placeholder="رمز عبور"
              ></b-form-input>
            </b-form-group>

            <div class="d-flex justify-content-center col-12">
              <b-button
                type="button"
                class="btn btn-login w-100"
                v-on:click="login()"
              >
                ورود</b-button
              >
            </div>
          </b-form>
        </div>
      </div>
      <div class="col-lg-6 p-0 login-pic-row">
        <img
          src="../assets/pics/loginbg.jpg"
          height="400px"
          alt="login-pic"
          class="login-pic w-100"
        />
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      axiosResponse: "",
      statusCode: "",
      token: "",
    };
  },
  methods: {
    login() {
      var self = this;
      axios
        .post("/api/user/login", {
          email: this.email,
          password: this.password,
        })
        .then(function (response) {
          console.log(response);
          self.statusCode = response.data.status;
          if (self.statusCode == 200) {
            alert("Logged In");

            self.token = response.data.data.token;
            console.log("User Token is " + self.token);
            sessionStorage.setItem("user_token", self.token);

            console.log(sessionStorage.getItem("auth"));
            self.$router.push("/secure");
          } else if (self.statusCode == 401) {
            alert("Incorrect email or password");
          } else if(self.statusCode == 403) {
            alert("User Not Verified");
          } else {
            alert("Fields Cannot be Empty And Must be in Correct Format");
          }
        })
        .catch(function (error) {
          alert("error");
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
.login-container {
  padding: 92px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.login-pic {
  filter: grayscale();
}
.login-title {
  font-weight: bold;
  color: black !important;
}
input {
  border-radius: 7px;
}
.btn-login {
  background-color: #25d366;
  border-color: #25d366;
}
.btn-login:hover {
  background-color: #039c10;
  border-color: #039c10;
}
@media screen and (max-width: 700px) {
  .login-container {
    padding: 0 px;
  }
  .login-pic-row {
    display: none;
  }
  .login-row {
    margin-top: 200px;
    margin-bottom: 20px;
    border: 0.5px solid rgb(172 172 172 / 45%);
    border-top-right-radius: 20px;
    border-top-left-radius: 20px;
    border-bottom-right-radius: 0px;
  }
}
</style>