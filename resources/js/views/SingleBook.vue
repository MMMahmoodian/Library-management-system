<template>
      <div class="single-book">
            <img class="icon" src="../assets/icons/book.svg" alt />
            <div class="book-info" v-if="!loading">
                  <p class="title">
                        <img src="../assets/icons/title.svg" alt="title" />
                        <span>عنوان:</span>
                        <span class="mr-1">{{book.title}}</span>
                  </p>
                  <div class="extra-info" v-if="book.authors">
                        <p>
                              <span class="font-bold">نویسنده:</span>
                              <span class="mr-2">{{book.authors[0].first_name}} {{book.authors[0].last_name}}</span>
                        </p>
                        <p>
                              <span class="font-bold">ناشر:</span>
                              <span class="mr-2">{{book.publisher.name}}</span>
                        </p>
                        <p>
                              <span class="font-bold">کد شابک:</span>
                              <span class="mr-2">{{book.isbn}}</span>
                        </p>
                        <!--<p>
                              <span class="font-bold">تاریخ انتشار:</span>
                              <span class="mr-2">{{book.publish_date}}</span>
                        </p>-->
                        <p>
                              <span class="font-bold">دسته بندی:</span>
                              <span class="mr-2">{{book.category.name}}</span>
                        </p>
                        <p>
                              <span class="font-bold">خلاصه:</span>
                              <span class="mr-2">{{book.synopsis}}</span>
                        </p>
                  </div>
                  <div class="lending-controller">
                      <button v-if="user == 'user'" @click="demandBook" class="mybtn" :disabled="!availability">{{availability? 'ثبت تقاضا' : 'ناموجود'}}</button>  
                      <p v-show="msg"> {{msg}} </p> 
                  </div>
            </div>
      </div>     
</template>

<script>
export default {
      data() {
            return {
                  book: {
                        title: "نام کتاب",
                        author: "حسن پودینه",
                        publisher: "سازمان فناوری اطلاعات",
                        isbn: "123456",
                        publish_date: "01/02/1372",
                        category: "گروه",
                        summary: "خلاصه ای در مورد کتاب",
                  },
                  availability: null,
                  loading : true,
                  msg : ''
            };
      },
      computed :{
            user: {
                  get(){
                        let obj = this.$store.getters;
                        if(obj['isAdmin']) return 'admin';
                        else if(obj['isStaff']) return 'staff';
                        else return 'user';
                  },
                  set(val) {
                        return val;
                  }
            }
      },
      methods: {
            async getBookInfo(id){
                  try {
                        let book_info = await axios.post("/api/management/book/info", {book_id:id});
                        this.availability = await book_info.data.data.avaiable;
                        return book_info.data.data;
                  }
                  catch (e) {
                        console.log(e)
                  } 
                  finally {
                        this.loading = false;
                  }
            },
            demandBook() {
                  let user_id = localStorage.getItem('user_id')
                  let book_id = this.book.id;
                  axios.post("/api/management/reservation/reserve", {
                        user_id: user_id,
                        book_id : book_id
                  }).then(res => {
                        if(res.status == '200') this.msg = "قبت تقاضا با موفقیت انجام شد."
                  })
                  //.catch(err => {
                  //      console.log(err)
                  //})
                  //      .then(function (response) {
                  //            console.log(response);
                  //            if (response.data.message == "Bad request!") {
                  //                  alert(response.data.data.error);
                  //            } else {
                  //                  alert("Book added");
                  //                  vm.$forceUpdate(); //location.relode()'
                  //            }
                  //      })
                  //      .catch(function (error) {
                  //            console.log(error);
                  //      });
            },
      },
      async mounted(){
            let id = this.$route.params.id;
            this.book = await this.getBookInfo(id);
      }
};
</script>

<style>
.single-book {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      padding: 20px;
      border-radius: 2px;
      margin-top: 60px;
      background: #f8f9fa;
}

.icon {
      width: 14%;
}

.book-info {
      width: 70%;
      padding: 20px;
      display: flex;
      flex-direction: column;
      margin-right: 60px;
      flex-grow: 1;
      align-items: baseline;
}

.loading {
      width: 70%;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      /*margin-right: 60px;*/
      flex-grow: 1;
      align-items: center;
}

.loader {
      width: 100px;
      height: 100px;
}

.title {
      font-size: 130%;
      font-weight: bold;
}
.publisher {
      font-size: 90%;
      color: rgb(206, 206, 206);
}
.extra-info {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: baseline;
      margin-top: 20px;
      /*margin-right: 20px;*/
}
.extra-info p {
      display: flex;
      align-items: center;
}
.font-bold {
      font-weight: bold;
}
.title img {
      width: 40px;
}
p img {
      width: 30px;
      margin-left: 10px;
}
.lending-controller{
      display: flex;
      justify-content: flex-end;
      width: 100%;
}

.mybtn {
  background-color: transparent;
  border: 2px solid rgb(226, 58, 58);
  border-radius: 0.6em;
  color: rgb(226, 58, 58);
  cursor: pointer;
  display: flex;
  align-self: center;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1;
  margin: 20px;
  padding: 1.2em 2.8em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
}

button:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
  cursor: not-allowed;
}


</style>