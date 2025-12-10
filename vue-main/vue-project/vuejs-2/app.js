const app = Vue.createApp({ 
    data(){ 
        return { 
            result: "",
            num: "",

        }
    },
    methods: {
        getdouble(){
            this.result = this.num * 2;
        },
        getsqr(){
            this.result = this.num * this.num;
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