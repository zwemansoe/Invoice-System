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
               <td> </td>
              </tr>
                @if(isset($inv)) 
              <?php foreach($inv as $i){ 
                  $t=0;
                  $r=unserialize($i->count_item);
                  foreach($r as $o){
                      $t+=$o;
                  }
              ?>
             <tr>
                  <td><a href="{{action('InvoiceController@edit',$i->id)}}">{{$i->invoice_name}}</a></td>
                  <td>{{$t}}</td>
                  <td>{{$i->total}}</td>
                  <td><a href="{{action("InvoiceController@pdf",$i->id)}}"><i class="fa fa-book" aria-hidden="true"></i>PDF</a><span></spa> <a href="{{action("InvoiceController@destroy",$i->id)}}">Remove<i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>
              <?php } ?>
              @else
              @foreach($show as $s)
                <?php 
                    $i=0;$t=0;
                    $sa=unserialize($s->count_item);
                     foreach ($sa as $p){
                        $i+=$p;
                    }
               //     unserialize($s->)
              ?>
              <tr>
                  <td><a href="{{action('InvoiceController@edit',$s->id)}}">{{$s->invoice_name}}</a></td>
                  <td>{{$i}}</td>
                  <td>{{$s->total}}</td>
                  <td><a href="{{action("InvoiceController@pdf",$s->id)}}"><i class="fa fa-book" aria-hidden="true"></i>PDF</a><span></span> <a href="{{action("InvoiceController@destroy",$s->id)}}">Remove<i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>
              @endforeach()
              @endif
            </table>
          
       </div>  
      <div class="pagination pull-right"> {{ $show->links() }} </div> 
</div>   
</div>

@endsection