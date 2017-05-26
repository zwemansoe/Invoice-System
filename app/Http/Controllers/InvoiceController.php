<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Invoice;
use App\Item;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Http\Requests\request_form_validate;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show=Invoice::with('items')->paginate(4);
       //  dd($show);
        //$show=Invoice::paginate(4);        
        $search=\Request::get('search');       
        $inv=Invoice::where('invoice_name','like','%'.$search.'%')
        ->orderBy('invoice_name')
        ->with('items')        
        ->paginate(4);
        
        return view('showInvoice',compact('show','inv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('invoice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request_form_validate $request)
    {    
        $itemname=$request->get('itemname');
        $price=$request->get('price');       
        $item=$request->get('quantity');
        if(in_array('',$item)){
            return redirect('/invoice/')->with('alert',' Field name is require!!');
        }
         if(in_array('',$price)){
            return redirect('/invoice/')->with('alert',' Field name is require!!');
        }      
       
        $id=Invoice::create([
            'invoice_name'=>$request->get('invoicename'),
            'subtotal'=>$request->get('subtotal'),
            'tax'=>$request->get('tax'),            
            'total'=>$request->get('total')
        ])->id;      
       
        
        Item::create([          
            'invoice_id'=>$id,
            'item_name'=>serialize($request->get('itemname')),
            'quantity'=>serialize($request->get('quantity')),
            'price'=>serialize($request->get('price')),
            'item_total'=>serialize($request->get('item_total'))
        ]);       
     
      return  redirect('/invoices')->with('success','successfully inserted');       
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request_form_validate $request,$id)
    {    
        $itemname=$request->get('itemname');
        $price=$request->get('price');       
        $item=$request->get('quantity');
        if(in_array('',$item)){
            return redirect('/invoice/')->with('alert',' Field name is require!!');
        }
         if(in_array('',$price)){
            return redirect('/invoice/')->with('alert',' Field name is require!!');
        }   
        
        DB::table('invoices')
            ->where('id',$id)
            ->update([
            'invoice_name'=>$request->get('invoicename'),
            'subtotal'=>$request->get('subtotal'),
            'tax'=>$request->get('tax'),            
            'total'=>$request->get('total')         
                ]);
      
        DB::table('items')
            ->where('invoice_id',$id)
            ->update([                
             'item_name'=>serialize($request->get('itemname')),
            'quantity'=>serialize($request->get('quantity')),
            'price'=>serialize($request->get('price')),
            'item_total'=>serialize($request->get('item_total'))
                ]);
          return redirect('/invoices')->with('success','Successfully updated');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $edit=Invoice::where('id',$id)
                ->with('items') 
                ->get();
      
        return view('table.editTable',compact('edit'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $inv=Invoice::find($id);
        $inv->items()->delete();
        Invoice::destroy($id);
        return redirect('/invoices')->with('success','Successfully Deleted');
    }
    
    public function pdf($id){
              
        $pdfdata=Invoice::where('id',$id)
                ->with('items') 
                ->get();
      
        view()->share('pdfdata',$pdfdata);
         $pdf = PDF::loadView('pdf');
         return $pdf->download('pdf.pdf');
    }
  
}
