<div class="col-md-8 col-md-offset-2">
   
 <div class="hero is-info">  
      <legend>New Invoice</legend>      
 </div>     
            <form method="post" id='formtable'>
                 @foreach($errors->all() as $e)
                   <p class="alert alert-danger">{{$e}}</p>
                 @endforeach  
                 @if(session('alert'))
                 <p class="alert alert-danger">{{session('alert')}}</p>                     
                 @endif()
                {{csrf_field()}}
                 <div class="form-inline invoices_top">
                     <div class="form-group">
                      <label for="name">Invoice Name</label>
                          <input v-model="invoicename" name="invoicename" type="text" class="form-control input is-warning" id="name" placeholder="Invoice Name">
                    </div>
                </div>
          
                    <div class="table-responsive invoices_top">
                       <table class=" table is-striped" >
                            <tr class="success">
                                <td>Item Name</td>
                                <td>#of items</td>
                                <td>Price</td>
                                <td>Total</td>
                                <td></td>
                            </tr>
                            <tbody class="detail">                            
                             <tr class="info"  >
                                 <td><input  name="itemname[]" v-model="itemname" class="form-control input is-success itemname" type="text"></td>
                                 <td><input  name="item[]" v-model="count"  class="form-control input is-success item" type="text"></td>
                                <td><input   name="price[]" v-model="price"  class="form-control input is-success price" type="text"></td>
                                <td><input    v-model="amounts" class="form-control input is-success total" type="text" value="@{{ count * price }}"  disabled></td>
                                <td></td>
                            </tr>
                            
                           
                               <tr v-for="(key,item) in list"  style="margin-bottom: 5px;" class="info" v-show="liststatus"  >                          
                                 <td><input name="itemname[]" v-model="item.itemname"    class="form-control input is-success itemname" type="text"></td>
                                 <td><input name="item[]" v-model="item.count"  class="form-control input is-success item" type="text"></td>
                                <td><input  name="price[]"  v-model="item.price"   class="form-control input is-success price" type="text"></td>
                                <td><input   v-model="item.amount" class="form-control input is-success total"  value="@{{ item.count * item.price }}" type="text" disabled></td>
                                <td @click="removeElement"><i id="trash" class="fa fa-trash-o" aria-hidden="true"></i></td>
                          
                               </tr>
                            
                            </tbody>
                       </table>
                    </div>
                <div class="form-group">
                     <button  @click="clicks" type="button" class="button is-danger is-inverted"><i class="fa fa-plus-square" aria-hidden="true"></i>Add Item</button>
                </div>  
                
                <div class="form-group col-md-offset-7">
                     <div class="table-responsive">
                          <table class="table">
                            <tr class="info">
                                 <td>Sub Total</td> 
                                 <td><input name="" v-model="subtotal + (count * price )" class="form-control input is-primary" type="text" valeu="@{{ subtotal + (count * price)}}" disabled></td>
                            </tr>
                            <tr class="info">
                                 <td>Tax</td> 
                                 <td><input  name="" v-model="tax" type="text" class="form-control input is-primary"></td>
                            </tr>
                             <tr class="info">
                                 <td>Total</td> 
                                 <td><input name="" v-model="subtotal+(count*price)+((subtotal/100)*tax) + (((count * price)/100)*tax)" value="@{{subtotal+(count*price)+((subtotal/100)*tax) + (((count * price)/100)*tax)}}" class="t form-control input is-primary" type="text"  v-text="total" disabled></p></td>
                                <input type="hidden" v-model="subtotal+(count*price)+((subtotal/100)*tax) + (((count * price)/100)*tax)"  name="total" >
                            </tr>
                          </table>           
                </div>
                </div>
                <button type="submit" class="button is-success is-outlined">Create</button>
        </form>

</div>
