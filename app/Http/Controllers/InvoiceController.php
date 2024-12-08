<?php

namespace App\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class InvoiceController extends Controller

{
    public function InvoiceGenerate(){
//         $order_number = '1733551224';
// // return DB::table('orders')->get();
//    $orders =  DB::table('orders')
// ->join('order_details','orders.order_number', '=' , 'order_details.order_number')
// ->join('books','book_id', '=' , 'order_details.book_id')
// ->where('orders.order_number',$order_number)
// ->get();

//  return view('productInvoice', compact('orders', 'order_number' ));



$order_number = '1733551224';

$order = DB::table('orders')->where('order_number', $order_number)->get();
$orderdetails = DB::table('order_details')
->join('books','book_id', '=' , 'order_details.book_id')
->where('order_details.order_number',$order_number)->get();


// return view('productInvoice', compact('order', 'order_number','orderdetails' ));




$data = [

    'orderdetails' =>$orderdetails,
    'order' => $order,

    'order_number' => $order_number

]; 

$pdf = PDF::loadView('productInvoice', $data);

// return $pdf->download('invoice.pdf');
return $pdf->stream();

    }
}



// $users = DB::table('users')
//             ->join('contacts', 'users.id', '=', 'contacts.user_id')
//             ->join('orders', 'users.id', '=', 'orders.user_id')
//             ->select('users.*', 'contacts.phone', 'orders.price')
//             ->get();