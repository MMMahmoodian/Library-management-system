<template>
    <div class="container-fluid employee-container">
        <div class="row mt-4">
            <div class="header col-lg-8 col-8">
                <h4>لیست دسته بندی ها</h4>
            </div>
        </div>

        <table class="table mt-4">
            <thead class="thead-dark">
            <tr>
                <th scope="col">شناسه کاربر</th>
                <th scope="col">شناسه کتاب</th>
                <th scope="col">تاریخ قرض</th>
            </tr>
            </thead>
            <tbody>
            <tr v-bind:key="cat.id" v-for="cat in rentArray" v-on:click="Withdraw(cat)">
                <td>{{cat.user_id}}</td>
                <td>{{cat.book_id}}</td>
                <td>{{cat.renting_date}}</td>
            </tr>

            </tbody>
        </table>

    </div>
</template>
<script>
export default {
    data() {
        return {
            name: "",
            selected: "وضعیت",
            rentArray:[],
        };
    },
    methods: {
        fetchArrays: function () {
            var self = this;
            axios
                .get("http://localhost:8000/api/management/rental/on-going")
                .then(function (response) {
                    self.rentArray = response.data.data;
                    console.log(self.rentArray);
                    self.rentArray.forEach((element) => {
                        self.categoryOptions.push({
                            text: element.name,
                            value: element.id,
                        });
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        Withdraw: function (self) {
            debugger;
            var cur = new Date();
            console.log("HHHHHHHHHHHHH");
            axios
                .post("http://localhost:8000/api/management/rental/withdraw", {
                    user_id: self.user_id,
                    book_id: self.book_id,
                    withdraw_date: cur,
                })
                .then(function (response) {
                    console.log(response);
                    if ((response.data.message != "Bad request!")) {
                        alert("Book Withdrawn");
                    } else {
                        alert("Not withdrawn");
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            debugger;
        },
    },

    created() {
        this.fetchArrays();

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
