<?php

namespace App\Http\Controllers;

use App\Models\dataWarehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class dataWarehouseController extends Controller
{
    //
    public function index()
    {
        // $data = dataWarehouse::all(); // Fetch all records from the table

        $combinedData = DB::connection('mysql_second')->table('fact_sales')
        ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
        ->join('dim_customers', 'fact_sales.sk_customers', '=', 'dim_customers.sk_customers')
        ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
        ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
        ->join('dim_times', 'fact_sales.sk_times', '=', 'dim_times.sk_times')
        ->select(
            'fact_sales.*', 
            'dim_books.book_name', 'dim_books.book_stock_A', 'dim_books.book_stock_B', 'dim_books.book_price', 'dim_books.book_category',
            'dim_customers.customer_name', 'dim_customers.email', 'dim_customers.phone', 'dim_customers.address',
            'dim_orders.order_id', 'dim_orders.order_detail_id', 'dim_orders.book_qty', 'dim_orders.subtotal',
            'dim_stores.store_name', 'dim_stores.store_region', 'dim_stores.store_address', 'dim_stores.store_id',
            'dim_times.day', 'dim_times.month_name', 'dim_times.year', 'dim_times.created_at'
        )
        ->get();

        return view('dw', compact('combinedData')); // Return data to view
    }
}
