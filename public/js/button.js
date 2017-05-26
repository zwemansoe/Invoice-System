/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 

 * written by zwe
 */
 
    $(function(){
        $i=0;
       
       $('#addItembutton').click(function(){
          addnewrow();
       });
     
           $('body').delegate('#trashbutton','click',function(){             
               $(this).parent(true).parent(true).remove();       
       });
           $('body').delegate('.itemnamebutton,.itembutton,.pricebutton,.totalbutton','keyup',function(){
              $('.taxbutton').val(0);
               var tr=$(this).parent().parent();
               var num=tr.find('.itembutton').val();
               var price=tr.find('.pricebutton').val();
                amount=num*price;
               tr.find('.totalbutton').val(amount);              
               subTotal();
           });
           $('body').delegate('.taxbutton','keyup',function(){
               tax();
           });        
           
            
      
       function addnewrow(){        
         
           var n=$i++;
           var tr='<tr class="info">'+
                '<input type="hidden" value='+n+'>'+  
                '<td><input name="itemname[]" class="form-control input is-success itemnamebutton" type="text"></td>'+
                '<td><input  name="quantity[]" class="form-control input is-success itembutton" type="text"></td>'+
                '<td><input name="price[]" class="form-control input is-success pricebutton" type="text"></td>'+
                '<td><input name="item_total[]" class="form-control input is-success totalbutton"></p></td>'+
                '<td><i id="trashbutton" class="fa fa-trash-o" aria-hidden="true"></i></td>'+
                '<tr>';
          $('.detailbutton').append(tr);   
       };
       function subTotal(){ 
              var sub_t=0;
            $('.totalbutton').each(function(k,v){
               var subt=$(this).val()-0;            
                sub_t+=subt;               
            });
           
           $('.subtotalbutton').val(sub_t);
           
        } 
       function tax(){
          
           var tax=$('.taxbutton').val()-0;
           var s=$('.subtotalbutton').val()-0;
           var taxsub=(s/100)*tax+s
           $(".tbutton").val(taxsub);
           $('.ttbutton').val(taxsub);
       } 
    });
    
