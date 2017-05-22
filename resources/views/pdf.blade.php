@extends('layout.master')
@section('title','Show Invoice')
@section('content')

 @foreach($pdfdata as $ed)
   <table cellspacing="1" class="tbl">
                            <tr class="success">
                                <td>Item Name</td>
                                <td>#of items</td>
                                <td>Price</td>                              
                            </tr>
                            <tbody >
                           
                    <?php 
                            $item_name=unserialize($ed->item_name);
                            $count_item=unserialize($ed->count_item);
                            $prices=unserialize($ed->price);  
                            //var_dump($prices[]);exit;
                            for($i=0;$i<count($item_name);$i++){
                    ?>
                                <tr>
                                    <td>{{$item_name[$i]}}</td>
                                    <td>{{$count_item[$i]}}</td>
                                    <td>{{$prices[$i]}}</td>                                    
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