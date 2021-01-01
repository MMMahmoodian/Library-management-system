import axios from "axios";

const state = {
  user: null,
  admin: false,
  staff: false,
};

const getters = {
  isAuthenticated: (state) => !!state.user,
  isAdmin: (state) => !!state.admin,
  isStaff: (state) => !!state.staff,

  StateUser: (state) => state.user,
};

const actions = {

  async LogInAdmin({ commit }, admin) {
    console.log("Beginning Admin Login process..");
    var self = this;
    axios
      .post("/api/user/login", {
        email: admin.get("userName"),
        password: admin.get("password"),
      })
      .then(function (response) {
        console.log(response);
        self.statusCode = response.data.status;
        if (self.statusCode == 200) {
          self.token = response.data.data.token;
          console.log("role : ", response.data.data.role[0].name);
          if (response.data.data.role[0].id != 1) {
            alert("INVALID USER");
          } else {
            alert("Admin Logged In");
            commit("setAdmin");
          }

        } else if (self.statusCode == 400) {
          alert("Incorrect email or password");
        } else if (self.statusCode == 403) {
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

  async LogInStaff({ commit }, staff) {
    console.log("Beginning Staff Login process..");
    var self = this;
    axios
      .post("/api/user/login", {
        email: staff.get("userName"),
        password: staff.get("password"),
      })
      .then(function (response) {
        console.log(response);
        self.statusCode = response.data.status;
        if (self.statusCode == 200) {
          self.token = response.data.data.token;
          console.log("role : ", response.data.data.role[0].name);
          if (response.data.data.role[0].id != 2) {
            alert("INVALID USER");
          } else {
            alert("Staff Logged In");
            commit("setStaff", staff.get("userName"));
          }

        } else if (self.statusCode == 401) {
          alert("Incorrect email or password");
        } else if (self.statusCode == 403) {
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

  async LogIn({ commit }, user) {
    console.log("Beginning Login process..");
    var self = this;
    axios
      .post("/api/user/login", {
        email: user.get("email"),
        password: user.get("password"),
      })
      .then(function (response) {
        console.log(response);
        self.statusCode = response.data.status;
        if (self.statusCode == 200) {
          alert("Logged In");

          self.token = response.data.data.token;
          console.log("role : ", response.data.data.role[0].name);
          console.log("User Token is " + self.token);
          commit("setUser", user.get("email"));


        } else if (self.statusCode == 401) {
          alert("Incorrect email or password");
        } else if (self.statusCode == 403) {
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

  async LogOut({ commit }) {
    let user = null;
    commit("logout", user);
  },

};

const mutations = {
  setUser(state, email) {
    state.user = email;
  },

  setAdmin(state) {
    state.user = "admin";
    state.admin = true;
  },

  setStaff(state, email) {
    state.user = email;
    state.staff = true;
  },

  logout(state, user) {
    state.user = user;
    state.admin = false;
    state.staff = false;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
