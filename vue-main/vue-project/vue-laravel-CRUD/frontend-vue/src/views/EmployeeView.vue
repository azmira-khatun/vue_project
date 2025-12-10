<template>
  <main>
     <div class="container"> 
      <div class="card" style="width: 95%; padding:5%">
        <div class="card-header"> 
          <h2>Employee Registation</h2>
          <form @submit.prevent="save">
          
          <div class="form-group">
              <label>Employee name</label>
              <input type="text" v-model="employee.name" class="form-control"  placeholder="Employee name">
                <p class="error" v-if="employeeError" style="color: crimson;"> {{ employeeError }}</p>
          </div>

          <div class="form-group">
              <label>Employee Address</label>
              <input type="text" v-model="employee.address" class="form-control"  placeholder="Employee Address">
          
          </div>

          
          <div class="form-group">
              <label>Mobile</label>
              <input type="text" v-model="employee.mobile" class="form-control"  placeholder="Mobile">
          
          </div>
        
          <button type="submit" class="btn btn-primary">Save</button>
          </form>
       
        </div> 
        <div class="card-body"> 
          
          <table class="table table-success table-striped"> 
            <thead> 
              <tr> 
                <th scope="col">ID</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Address</th>
                <th scope="col">Mobile</th>
                <th scope="col">Option</th>
              </tr>
            </thead>
            <tbody> 

              <tr v-for="employee in result" v-bind:key="employee.id">
          
                <td>{{ employee.id }}</td>
                <td>{{ employee.name }}</td>
                <td>{{ employee.address }}</td>
                <td>{{ employee.mobile }}</td>
                <td>
                  <button type="button" class="btn btn-warning" @click="edit(employee)">Edit</button>
                  <button type="button" class="btn btn-danger"  @click="remove(employee)">Delete</button>
                </td>
              </tr>
              <!-- <tr v-for="(student,index) in this.students" :key="index"> 
                <td>{{ student.id }}</td>
               <td> 
                <router-link to="/" class="btn btn-sucess">
                  edit
                </router-link>
                <button type="button" class="btn btn-danger">Delete</button>
               </td>
                
              </tr> -->
            </tbody>
          </table>
        </div>

      </div>
     </div>
  </main>
</template>
<script> 
import axios from 'axios'
 export default { 
  name: 'home',
  data() {
    return {
      result: {},
        employee:{
                   id: '',
                   name: '',
                   address: '',
                   mobile: ''
        }
    }
  },
  // created() { 
  //       this.getEmployees();
  //   },
  watch: { 
    'employee.name': function(){ 
      if(this.employee.name.length<5){ 
        this.employeeError ="Name must be at least 5 charecter long.";
      }else{ 
        this.employeeError ="";
      }
    }
  },
  mounted(){ 
    this.getEmployees();
    console.log("mounted() called.......");
  },
computed:{ 
  booklist(){ 
    return this.$store.state.booklist
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
            if(this.employee.id == '')
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
                 this.employee.name = '';
                  this.employee.address = '',
                  this.employee.mobile = ''
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
              var editrecords = 'http://127.0.0.1:8000/api/update/'+ this.employee.id;
              axios.put(editrecords, this.employee)
              .then(
                ({data})=>{
                  this.employee.name = '';
                  this.employee.address = '',
                  this.employee.mobile = ''
                  this.id = ''
                  alert("Updated!!!");
                  this.EmployeeLoad();
                }
              );
 
           },
 
           remove(employee){
 
             var url = `http://127.0.0.1:8000/api/delete/${employee.id}`;
 
 
             // var url = 'http://127.0.0.1:8000/api/delete/'+ employee.id;
              axios.delete(url);
              alert("Deleteddd");
              this.EmployeeLoad();
            }
      }
  }
 
</script>