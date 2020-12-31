import axios from "axios";

const state = {
  user: null,
};

const getters = {
  isAuthenticated: (state) => !!state.user,

  StateUser: (state) => state.user,
};

const actions = {
  async Register({dispatch}, form) {
    
  },

  async LogIn({commit}, user) {
    console.log("Beginning Login process");
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

  async GetPosts({ commit }) {
    // let response = await axios.get("posts");
    // commit("setPosts", response.data);
  },

};

const mutations = {
  setUser(state, email) {
    state.user = email;
  },

  logout(state, user) {
    state.user = user;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
