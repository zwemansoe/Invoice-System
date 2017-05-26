@extends('layout.master')
@section('title','Show')
@section('content')
  
 
<div class="col-md-8 col-md-offset-2 invoices_top">
    <div class="container-fluid">
      <div class="form-inline">          
                 @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                 @endif()
<form method="GET"  action="{{action('InvoiceController@index') }}">
    <input type="hidden" value="csrf_token()">    
    <input type="text" name="search" class="form-control input is-primary" id="" placeholder="Search....">
     <button type="submit" class="button is-dark "><i class="fa fa-search" aria-hidden="true"></i>Search</button>
   <a href={{url('/invoice/')}} class="button is-success is-outlined pull-right">Add Invoice</a>
</form>
  </div>
  </div>


   
    <div class="is-light invoicestop">       
            <table class="table is-bordered is-striped is-narrow">
              <tr  class="is-selected">
               <td>Invoice Name</td>
               <td>#of Items</td>
               <td>Total</td>
               <td> </td> <td> </td>
              </tr> 
               @if(isset($inv))
                  @foreach($inv as $s)
                <?php              
                    foreach($s->items as $item){                  
                     $count=unserialize($item->quantity);
                       $t=0;                
                      foreach($count as $o){
                          $t+=$o;
                      }                  
                ?> 
              <tr>
                  <td><a href="{{action('InvoiceController@edit',$s->id)}}">{{$s->invoice_name}}</a></td>
                  <td>{{$t}}</td>
                  <td>{{$s->total}}</td>
                  <td><a href="{{action("InvoiceController@pdf",$s->id)}}"><i class="fa fa-book" aria-hidden="true"></i>PDF</a>
                  </td>
                  <td>
                      <form action="invoice/{{$s->id}}" method="post">
                         {{csrf_field()}}
                         <input type="hidden" name="_method" value="DELETE">   
                         <input style="margin-bottom: 1em" class="button is-danger is-small" type="submit" value="delete " >
                      </form>
                  </td>
              </tr>
               <?php 
                  };               
               ?>  
              @endforeach()  
              @else
              @foreach($show as $s)
                <?php              
                foreach($s->items as $item){                  
                 $count=unserialize($item->quantity);
                   $t=0;                
                  foreach($count as $o){
                      $t+=$o;
                  }                  
                ?> 
              <tr>
                  <td><a href="{{action('InvoiceController@edit',$s->id)}}">{{$s->invoice_name}}</a></td>
                  <td>{{$t}}</td>
                  <td>{{$s->total}}</td>
                  <td><a href="{{action("InvoiceController@pdf",$s->id)}}"><i class="fa fa-book" aria-hidden="true"></i>PDF</a><span></span> 
                  </td>
                  <td>
                      <form action="invoice/{{$s->id}}" method="post">
                         {{csrf_field()}}
                         <input type="hidden" name="_method" value="DELETE" >
                        <input style="margin-bottom: 1em" class="button is-link" type="submit" value="delete " >
                      </form>
                  </td>
              </tr>
               <?php 
                  };               
                ?>  
              @endforeach()
              @endif
            </table>
          
       </div>  
 
      <div class="pagination pull-right"> {{ $show->links() }} </div> 
</div>   
</div>

@endsection