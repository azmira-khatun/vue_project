<template>
  <div class="about">
    <main>
      <div class="container"> 
       <div class="card" style="width: 95%; padding:5%">
         <div class="card-header"> 
           <h2>Employee Registation</h2>
           <form @submit.prevent="save">
           
           <div class="form-group">
               <label>Name</label>
               <input type="text" v-model="name" class="form-control"  placeholder="Employee name" required>
              <p style="color:red" v-if="nemError"> 
                {{ nemError }}
              </p>
           
           </div>
           <div class="form-group">
            <label>Email</label>
            <input type="text" v-model="name" class="form-control"  placeholder="Employee Email" re>
              <p style="color:red" v-if="nemError"> 
                {{ emailError }}
              </p>
           </div>
           <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
           <div class="form-group">
            <label>Email</label>
            <input type="text" v-model="email" class="form-control"  placeholder="Employee name">
              <p style="color:red" v-if="nemError"> 
                {{ nemError }}
              </p>
           </div>
 
           <div class="form-group">
               <label>Employee Address</label>
               <input type="text" v-model="address" class="form-control"  placeholder="Employee Address" required>
           </div>
           <div class="form-group">
            <button @click="count++" type="submit" class="btn btn-primary">Increment</button>{{ count }}
            <button @click="count--" class="btn btn-primary">Decrement</button>
        </div>
           <div class="form-group">
               <label>Mobile</label>
               <input type="text" v-model="mobile" class="form-control"  placeholder="Mobile">
           </div>
           <div class="form-group">
            <label>Mobile</label>
            <input type="text" v-model="mobile" class="form-control"  placeholder="Mobile">
        
        </div>
           
           <button type="submit" class="btn btn-primary">Save</button>
           </form>
        
         </div> 
 
       </div>
      </div>
   </main>
  </div>
  
</template>
<script>
import axios from 'axios'
 export default { 
  name: 'AboutPage',
  data() {
    return {
      result: {},
          id: '',
          name: '',
          address: '',
          count:0,
          mobile: '',
          nemError:'',
          email: '',
          emailError: ''
    }
  },
  // created() { 
  //       this.getEmployees();
  //   },
  mounted(){ 
    this.getEmployees();
    console.log("mounted() called.......");
  },

watch:{ 
  count(newValue, oldValue){ 
   if(newValue>oldValue && newValue==5){ 
    alert("Danger Point");
   }
  },
  'name': function(){
    if(this.name.length <7){
      this.nemError ="Name must be at least 7 characters long";
    } else{ 
      this.nemError ="";
    }
  },
  'email': function(){ 
    if(this.email){ 

    }
  }
},

  methods: {
    // getEmployees(){ 
    //   axios.get('http://127.0.0.1:8000/api/employees').then(res => { 
    //     this.employee = res.data.employees
    //     // console.log(res)
    //   });
    // }

    getEmployees()
           {
                 var page = "http://127.0.0.1:8000/api/employees";
                 axios.get(page)
                  .then(
                      ({data})=>{
                        console.log(data);
                        this.result = data;
                      }
                  );
           },
           save()
           {
            if(this.id == '')
              {
                this.saveData();
              }
              else
              {
                this.updateData();
              }       
 
           },
           saveData()
           {
            axios.post("http://127.0.0.1:8000/api/save", this.employee)
            .then(
              ({data})=>{
                alert("saveddddd");
                this.EmployeeLoad();
                 this.name = '';
                  this.address = '',
                  this.mobile = ''
                   this.id = ''
              }
            )
 
           },
           edit(employee)
           {
            this.employee = employee;
           
           },
           updateData()
           {
              var editrecords = 'http://127.0.0.1:8000/api/update/'+ this.id;
              axios.put(editrecords, this.employee)
              .then(
                ({data})=>{
                  this.name = '';
                  this.address = '',
                  this.mobile = ''
                  this.id = ''
                  alert("Updated!!!");
                  this.EmployeeLoad();
                }
              );
 
           },
 
           remove(employee){
 
             var url = `http://127.0.0.1:8000/api/delete/${id}`;
 
 
             // var url = 'http://127.0.0.1:8000/api/delete/'+ id;
              axios.delete(url);
              this.EmployeeLoad();
            }
      }
  }
 
</script>
