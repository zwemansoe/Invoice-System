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
                            $item_name=unserialize($ed->item_name);
                            $count_item=unserialize($ed->count_item);
                            $prices=unserialize($ed->price);  
                            //var_dump($prices[]);exit;
                            for($i=0;$i<count($item_name);$i++){
                    ?>
                                <tr class="info">
                                    <td><input  name="itemname[]" value="{{$item_name[$i]}}" class="form-control  input is-success itemnamebutton" type="text"></td>
                                    <td><input v-model="count[]" name="item[]" class="form-control  input is-success itembutton" value="{{$count_item[$i]}}" type="text"></td>
                                    <td><input v-model="price[]"  name="price[]" class="form-control  input is-success pricebutton" value="{{$prices[$i]}}" type="text"></td>
                                    <td><input v-model="totalone[]" class="form-control input is-success totalbutton"  type="text"  v-text="totalone" disabled></p></td>
                                    <td @click="removeElement"><i id="trashbutton" class="fa fa-trash-o" aria-hidden="true"></i></td>
                                </tr>
                    <?php   } ?>
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
                                 <td><input v-model="subtotal" class="subtotalbutton form-control input is-primary" type="text" disabled></td>
                            </tr>
                             @endforeach() 
                            <tr class="warning">
                                 <td>Tax</td> 
                                 <td><input @keyup="taxx" v-model="tax" type="text" class="form-control input is-primary taxbutton"></td>
                            </tr>
                             <tr class="warning">
                                 <td>Total</td> 
                                 <td><input  class="form-control input is-primary tbutton " type="text"  disabled></td>
                             <input type="hidden"  name="total" class="ttbutton" >
                            </tr>
                          </table>
                </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
</div>
