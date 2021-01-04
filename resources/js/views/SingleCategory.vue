<template>
  <div class="container-fluid employee-container">
    <div class="row mt-4">
    <table v-if="categoryArray.length" class="table mt-4">
      <thead class="thead-dark">
        <tr>
          <th scope="col">شناسه</th>
          <th scope="col">عنوان</th>
          <th scope="col">کد شابک</th>
          <th scope="col">شناسه نویسنده</th>
          <th scope="col">تاریخ انتشار</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in categoryArray" :key="`item-${index}`">
          <td>{{ item.id }}</td>
          <td>{{ item.title }}</td>
          <td>{{ item.isbn }}</td>
          <td>{{ item.authors[0].id }}</td>
          <td>{{ item.publish_date || 'ثبت نشده' }}</td>
        </tr>
      </tbody>
    </table>
    <div v-else>
          اطلاعاتی برای نمایش وجود ندارد.
    </div>
    </div>
  </div>
</template>
<script>
export default {
      props: {
            id : [Number, String]
      },
      data() {
            return {
                  name: "",
                  selected: "وضعیت",
                  categoryArray: [],
            };
      },
      methods:{
            async get_category_list(id) {
                  let list = await axios.post("/api/management/book/category-list", {category_id : id});
                  return list.data.data;
            }
      },
      async mounted(){
            let id = this.$route.params.id;
            let category_list = await this.get_category_list(id);
            this.categoryArray = category_list;
      },
};
</script>
<style scoped>
.employee-container {
  padding: 96px;
}
.new-employee-btn {
  background-color: #1f369a;
  color: white;
}
.new-employee-btn:hover {
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
}
@media screen and (max-width: 700px) {
  .employee-container {
    padding: 0;
  }
}
.delete-text {
  display: flex;
  justify-content: flex-end;
}
</style>
<style>
.modal-title {
  display: flex;
  justify-content: center;
  width: -webkit-fill-available;
}
</style>
