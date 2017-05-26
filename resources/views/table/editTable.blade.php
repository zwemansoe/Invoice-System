@extends('layout.master')
@section('title','Edit')
@section('content')
<div class="col-md-8 col-md-offset-2">

<div class="hero is-info"> 
                 @foreach($errors->all() as $e)
                   <p class="alert alert-danger">{{$e}}</p>
                 @endforeach
                 @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                 @endif()
      <legend>New Invoice</legend>
 </div>
            <form method="POST" id='formtablex'>
                <input type="hidden" name="_method" value="PUT">             
                {{csrf_field()}}
                 <div class="form-inline">
                     <div class="form-group">
                         @foreach($edit as $ed)
                      <label for="name">Invoice Name</label>
                      <input  name="invoicename" value="{{$ed->invoice_name}}" type="text" class="form-control input is-warning" id="name" placeholder="Invoice Name">
               
                    </div>
                </div>
                    <div class="table-responsive invoices_top">
                       <table class="table">
                            <tr class="success">
                                <td>Item Name</td>
                                <td>#of items</td>
                                <td>Price</td>
                                <td>Total</td>
                                <td></td>
                            </tr>
                            <tbody class="detailbutton">
                           
                    <?php 
                         $it=array();
                          foreach($ed->items as $item){
                              $count=unserialize($item->quantity);
                              $item_name=unserialize($item->item_name);
                              $price=unserialize($item->price);
                              $item_total=unserialize($item->item_total);//var_dump(count($item)); 
                         
                               for($i=0;$i<count($item_name);$i++){
                    ?>
                                <tr class="info">
                                    <td><input  name="itemname[]" value="{{$item_name[$i]}}" class="form-control  input is-success itemnamebutton" type="text"></td>
                                    <td><input v-model="count[]" name="quantity[]" class="form-control  input is-success itembutton" value="{{$count[$i]}}" type="text"></td>
                                    <td><input v-model="price[]"  name="price[]" class="form-control  input is-success pricebutton" value="{{$price[$i]}}" type="text"></td>
                                    <td><input v-model="totalone[]" name="item_total[]" class="form-control input is-success totalbutton"  value="{{$item_total[$i]}}" type="text"  v-text="totalone"></p></td>
                                    <td ><i id="trashbutton" class="fa fa-trash-o" aria-hidden="true"></i></td>
                                </tr>                         
                              <?php   }; }; ?>
                            </tbody>
                       </table>
                    </div>
                <div class="form-group">
                     <button  @click="handle(additem,num++)" id="addItembutton" type="button" class="button is-danger is-inverted"><i class="fa fa-plus-square" aria-hidden="true"></i>Add Item</button>
                </div> 
                <div class="form-group col-md-offset-7">
                     <div class="table-responsive">
                          <table class="table">
                            <tr class="warning">
                                 <td>Sub Total</td> 
                                 <td><input name="subtotal" v-model="subtotal" class="subtotalbutton form-control input is-primary" type="text" value="{{$ed->subtotal}}"></td>
                            </tr>
                           
                            <tr class="warning">
                                 <td>Tax</td> 
                                 <td><input name="tax" @keyup="taxx" v-model="tax" value="{{$ed->tax}}" type="text" class="form-control input is-primary taxbutton"></td>
                            </tr>
                             <tr class="warning">
                                 <td>Total</td> 
                                 <td><input  name="total" class="form-control input is-primary tbutton " type="text" value="{{$ed->total}}"></td>
                             <input type="hidden"  name="total" class="ttbutton" >
                            </tr>
                          </table>
                           @endforeach() 
                </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
</div>
