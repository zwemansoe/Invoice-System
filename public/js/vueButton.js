/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * written by zwe
 */

new Vue({
    el:'#formtable',
    data:{ 
     'list':[], 
     'listResult': '',
     'count':'',
     'price':'',
     'tax':'',

    },
    methods:{
         clicks:function(){            
           this.list.push({
                            itemname: '',
                            count: '',
                            price: '',
                            amount:'',
                        });
		    	},   
      
              removeElement: function (index) {
         this.list.splice(index,1);
     },  
  
    },
    computed:{
        liststatus:function(){
            
            return (this.list.length>0) ?true:false;
        },
        amount:function(){            
           return this.list.item.count * this.list.item.price;
        },
        amounts:function(){            
           return this.count * this.price;
        },
        subtotal: function(){
                return this.list.reduce(function(amount, item){
                return amount + (item.count * item.price);
            },0);
        },
    
    }
   
});
    

