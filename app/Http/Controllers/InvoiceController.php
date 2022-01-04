<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\productos;
use App\Model\stock;
use App\Model\invoice;


class InvoiceController extends Controller
{    
    public function index()
    {
        return view('invoice.indexInvoice');
    }
    public function indexProductos()
    {
        return view('productos.indexProductos');
    }  
    public function generar()
    {
        return view('invoice.createdInvoice');
    }  

    public function getProductos()
    {
        return json_encode(productos::all());
    } 
    public function getInvoice()
    {
        return json_encode(invoice::all());
    } 

    public function getInvoiceDate($date)
    {        
        return json_encode(invoice::where('fecha',$date)->get());
    }

    public function saveItems(Request $request)
    {        
       $obj= new productos();
       $obj->nombre=$request['nombre'];
       $obj->descripcion=$request['descripcion'];
       $obj->precio=$request['precio'];
       $file=\Request::file('imagen');
       $destinationPath=public_path('images');       
       $file->move($destinationPath,$file->getClientOriginalName());              
       $obj->imagen=$file->getClientOriginalName();
       $obj->cantidad_minima=$request['cant_min'];
       $obj->save();
       return response()->json(['success'=>true,'producto'=>$obj],201);
    } 

    public function stock(Request $request)
    {        
       $obj= new stock();
       $obj->cantidad=$request['cantidad'];
       $obj->productos_id=$request['item'];       
       $obj->save();
       return response()->json(['success'=>true],201);
    }
    public function created(Request $request)
    {        
       $obj= new invoice();
       $obj->numero=$request['numero'];
       $obj->fecha=date('Y-m-d H:i');
       $obj->cantidad=$request['cantidad']; 
       $obj->total=$request['total']; 
       $obj->productos_id=$request['id_prod']; 
       $obj->save();
       return response()->json(['success'=>true],201);
    }
    
}
