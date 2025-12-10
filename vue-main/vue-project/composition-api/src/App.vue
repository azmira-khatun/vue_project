<script setup>
import { ref, reactive,onMounted, computed } from 'vue';
 
    // const name = ref('');
    // const email = ref('');

    const from = reactive({ 
      name:"",
      email:""

    })

    const changeValue =()=>{ 
      name.value ="p";
      email.value="q"
    }

    const categories = ['man','woman','kids'];
    const products = [ 
      { 
        name: "Keyboard",
        category: "Electronics",
        price:300,
        description: "Comes with dual mode--Bluetooth mode and 2.4GHz Wireless mode,which bring quick response, precise movement,stable connection & smoother tracking"
      },
      { 
        name: "Mouse",
        category: "Electronics",
        price:300,
        description: "Comes with dual mode--Bluetooth mode and 2.4GHz Wireless mode,which bring quick response, precise movement,stable connection & smoother tracking"
      }
    ]
    // onMounted(() => {
    //   changeValue();
    // })
    
    // const fullName = computed({
    //   get() {
    //     return firstName.value + ' ' + secondName.value
    //   }
    // })
// export default { 
//   data(){
//     return{ 
//       firstName: "x",
//       secondName: "y"
//     }
//   },
//   methods:{ 
//     changeValue(){ 
//       this.firstName="p",
//       this.secondName="q"
//     },
//     // mounted() {
//     //   return this.changeValue();
//     // }

//     computed:{ 
//       fullName(){ 
//         return this.firstName + ' ' + this.secondName;
//       }
//     }
//   }
// }

</script>

<template>
  <div>
    <h1>Method,computed,mounted,reactive and ref</h1> 
    </div><br>
  <div> 
    <input type="text" v-model="from.name">
    <h2>Name:{{ from.name }}</h2>
    <input type="text" name="email" v-model="from.email">
    <h2>Email:{{ from.email }}</h2>
    <button @click="changeValue">Add</button>
  </div>
  <div> 
    <ul> 
      <li v-for="(product, index) in products" key="index"> 
        {{product.name}}
      </li>
    </ul>
    <table class=""> 
        <tr> 
          <th>Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Description</th>
        </tr>
        <tr v-for="(product, index) in products" key="index"> 
          <td>{{ product.name }}</td>
          <td>{{ product.category }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.description }}</td>
        </tr>
      
    </table>
  </div>
</template>

<style>

</style>
