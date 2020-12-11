<template>
  <div
    :style="{ 'background-image': 'url(../assets/library.jpeg)' }"
    id="login"
  >
    <h1 class="logh">خوش آمدید</h1>
    <input
      type="text"
      name="username"
      v-model="email"
      placeholder="ایمیل"
    />
    <input
      type="password"
      name="password"
      v-model="password"
      placeholder="کلمه عبور"
    />
    <button type="button" v-on:click="login()">ورود</button>
    
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      axios
        .post("http://localhost:8000/api/user/login", {
          email: this.email,
          password: this.password
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
      // if (this.input.username != "" && this.input.password != "") {
      //   if (
      //     this.input.username == this.$parent.mockAccount.username &&
      //     this.input.password == this.$parent.mockAccount.password
      //   ) {
      //     this.$emit("authenticated", true);
      //     this.$router.replace({ name: "secure" });
      //   } else {
      //     console.log("The username and / or password is incorrect");
      //   }
      // } else {
      //   console.log("A username and password must be present");
      // }
    },
  },
};
</script>

<style scoped>
#login {
  width: 500px;
  background-image: linear-gradient(red, yellow);
  margin: auto;
  margin-top: 200px;
  padding: 20px;
}
.logh {
  color: aliceblue;
  text-align: center;
  font-size: 50pxs;
}
button {
  background-color: #4caf50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
button:hover {
  opacity: 0.8;
}
input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
</style>