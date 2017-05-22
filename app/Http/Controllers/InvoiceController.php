<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Invoice;
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
        $show=Invoice::paginate(4);        
        $search=\Request::get('search');       
        $inv=Invoice::where('invoice_name','like','%'.$search.'%')
        ->orderBy('invoice_name')
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
      
        $price=$request->get('price');       
        $item=$request->get('item');
        if(in_array('',$item)){
            return redirect('/invoice/')->with('alert',' Field name is require!!');
        }
         if(in_array('',$price)){
            return redirect('/invoice/')->with('alert',' Field name is require!!');
        }      
       
        Invoice::create([
            'invoice_name'=>$request->get('invoicename'),
            'item_name'=> serialize($request->get('itemname')),
            'count_item'=> serialize($request->get('item')),
            'price'=> serialize($request->get('price')),
            'total'=>$request->get('total')
        ]);
     
      return  redirect('/invoices')->with('success','successfully inserted');       
    }
   
 
 public function search($id){
     return 's';
     $show=Invoice::paginate(5);       
        $search=\Request::get('search');       
        $inv=Invoice::where('invoice_name','like','%'.$search.'%')
        ->orderBy('invoice_name')
        ->paginate(5);
        
        return view('showInvoice',compact('show','inv'));
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request_form_validate $request,$id)
    {
    
       DB::table('invoices')
            ->where('id',$id)
            ->update([
                'invoice_name' =>$request->get('invoicename'),
                'item_name'=>serialize($request->get('itemname')),
                'count_item'=>serialize($request->get('item')),
                'price'=>serialize($request->get('price')),
                'total'=>$request->get('total')                
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
        $edit=Invoice::where('id',$id)->get();  
        return view('table.editTable',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(request_form_validate $request, $id)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {     
        Invoice::destroy($id);
        return redirect('/invoices')->with('success','Successfully Deleted');
    }
    public function pdf($id){
              
        $pdfdata=Invoice::where('id',$id)->get();
        view()->share('pdfdata',$pdfdata);
         $pdf = PDF::loadView('pdf');
         return $pdf->download('pdf.pdf');
    }
  
}
