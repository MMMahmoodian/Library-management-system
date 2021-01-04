<template>
      <div class="container-fluid authors-container">
            <div class="row mt-4">
                  <div class="col-lg-2 col-5" v-if="isAdmin || isStaff" >
                        <b-button class="btn btn-light d-flex new-author-btn" v-b-modal.modal-1>نویسنده جدید</b-button>
                  </div>
                  <div class="col-lg-12 col-7">
                        <h4>لیست نویسنده ها</h4>
                  </div>
                  <b-modal ref="modal" id="modal-1" title="اضافه کردن نویسنده" hide-footer>
                        <div class="container-fluid p-0 d-flex justify-content-center">
                              <b-form class="row col-12 p-0 d-flex justify-content-center">
                                    <b-form-group
                                    class="col-lg-9"
                                    id="input-group-1"
                                    label-for="input-1"
                                    >
                                          <b-form-input
                                          id="input-3"
                                          v-model="first_name"
                                          aria-describedby="input-live-help input-live-feedback"
                                          placeholder="نام"
                                          ></b-form-input>
                                          <b-form-input
                                          class="mt-2"
                                          id="input-3"
                                          v-model="last_name"
                                          aria-describedby="input-live-help input-live-feedback"
                                          placeholder="نام خانوادگی"
                                          ></b-form-input>
                                    </b-form-group>

                                    <div class="d-flex justify-content-center col-lg-12">
                                    <b-button v-on:click="submitAuthor" class="btn new-employee"
                                    >ثبت نویسنده</b-button
                                    >
                                    </div>
                              </b-form>
                        </div>
                  </b-modal>
                  <table class="table mt-4">
                        <thead class="thead-dark">
                              <tr>
                                    <th scope="col">شناسه</th>
                                    <th scope="col">نام نویسنده</th>
                                    <th scope="col">نام خانوادگی نویسنده</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr v-for="(author, index) in authors"  v-bind:key="`cat-${index}`">
                                    <td>{{ author.id || 'ثبت نشده' }}</td>
                                    <td>{{ author.first_name }}</td>
                                    <td>{{ author.last_name }}</td>
                              </tr>
                        </tbody>
                  </table>
            </div>
      </div>
</template>
<script>
export default {
      data() {
            return {
                  authors: [],
                  first_name: '',
                  last_name:''
            };
      },
      methods: {
            async submitAuthor(){
                  if(!this.first_name || !this.last_name) return;
                  let author_info = {};
                  author_info['first_name'] = this.first_name;
                  author_info['last_name'] = this.last_name;
                  let authors_list = await axios.post("/api/management/author/add", author_info);
                  this.authors = await this.getAuthors();
                  this.$refs.modal.hide();
            },
            async getAuthors(){
                  let authors_list = await axios("/api/management/author/list");
                  return authors_list.data.data;
            }
      },
      computed:{
            isAdmin: function () {
                  return this.$store.getters.isAdmin;
            },
            isStaff: function () {
                  return this.$store.getters.isStaff;
            },
      },
      async mounted(){
            let authors = await this.getAuthors();
            this.authors = authors;
      },
};
</script>
<style scoped>
.authors-container {
  padding: 96px;
}
.new-author-btn {
  background-color: #1f369a;
  color: white;
}
.new-author-btn:hover {
  background-color: #1c5ee4;
  color: white;
}
form {
  direction: rtl;
}
.new-employee {
  background-color: #133ef7;
}
.new-employee:hover {
  background-color: #1c0097 !important;
}
.header h4 {
  font-weight: 800;
  margin: auto;
}

</style>
