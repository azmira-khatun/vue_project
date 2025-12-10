const app = Vue.createApp({ 
    data(){ 
        return { 
            title:"Hello Vue",
            isBolin:true,
            ok:"hjihi",
            name: "",
            mobile: "",
            count: 0,

        }
    },
    methods: {
        increment(){
            this.count++;
        },
        decrement(){
            this.count--;
        },
      
        handleKeyup(e) {
            this.name = e.target.value;
        },
        fromsubmitted (e) { 
            console.log("from submitted");
            e.preventDefault();
        }
    },

    computed: {
        gettitle(){ 
            return this.title;
          },
    },
    watch: { 
       mobile(newvalue, oldvalue){ 
        console.log(newvalue);
        if (isNaN(newvalue)) { 
            alert("Please enter number");
            this.mobile = oldvalue;
        }
         if (newvalue.length == 11) { 
            alert("Please enter 11 number");
         }

        }
        
    }
})
app.mount("#app");