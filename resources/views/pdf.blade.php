@extends('layout.master')
@section('title','Show Invoice')
@section('content')

 @foreach($pdfdata as $ed)
 <?php              
        foreach($ed->items as $item){                  
         $count=unserialize($item->quantity);
           $t=0;                
          foreach($count as $o){
           $t+=$o;
        } 
          
  ?> 
   <table cellspacing="1" class="tbl">
                            <tr class="success">
                                <td>Invoice Name</td>
                                <td>#of items</td>                                                            
                            </tr>
                            <tbody>
                                <tr>
                                    <td>{{$ed->invoice_name}}</td>
                                    <td>{{$t}}</td>                                                                      
                                </tr>
                    <?php   } ?>
                                <tr>
                                 <td>Total</td> 
                                 <td>{{$ed->total}}</td>                                 
                                </tr> 
                            </tbody>
                       </table>
  
@endforeach
@endsection