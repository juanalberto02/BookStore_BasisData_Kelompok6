<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\Order;
use App\Models\analytics;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $selectedStore = $request->input('store', 1); // Default to store_id 1 if no selection is made

        $totalbooks = books::where('store_id', $selectedStore)->count();

        $totalorders = Order::where('store_id', $selectedStore)->count();

        $totalrevenue = DB::connection('mysql_second')
                        ->table('fact_sales')
                        ->where('sk_stores', $selectedStore)
                        ->sum('Revenue');
        
        // DB::connection('mysql_second')->table('fact_sales')

        $results = DB::select("SELECT COUNT(books.book_name) AS bookName, categories.category_name
            FROM books
            LEFT JOIN categories ON categories.id = books.category_id
            WHERE books.store_id = $selectedStore
            GROUP BY books.category_id, categories.category_name
        ");

        $data_books_categories_A = "";
        foreach ($results as $result) {
            $data_books_categories_A .= "['" . $result->category_name . "', " . $result->bookName . "],";
        }

        $pieChartData = $data_books_categories_A;

        

        return view("analytics.analytics", compact('totalbooks', 'pieChartData','totalorders','totalrevenue'));
    }


    public function analyticsA()
    {
        // $data = analytics::all(); // ini buat di tampilkan di master ( master bisa filter data)
        //$dataA (ditampilin di admin A)
        //$dataB (ditampilin di admin B)
        $totalbooks = books::where('store_id', 1)->count();
        // $totalorders = DB::select('SELECT COUNT(orders_details.order_id)');
        $totalorders = Order::count();

        $results = DB::select("SELECT COUNT(books.book_name) AS bookName, categories.category_name
            FROM books
            LEFT JOIN categories ON categories.id = books.category_id
            WHERE books.store_id = 1
            GROUP BY books.category_id, categories.category_name
        ");

        $data_books_categories_A = "";
        foreach ($results as $result) {
            $data_books_categories_A .= "['" . $result->category_name . "', " . $result->bookName . "],";
        }

        $pieChartData = $data_books_categories_A;

        return view("analytics.analyticsA", compact('totalbooks', 'pieChartData'));
    }

    public function analyticsB()
    {
        // $data = analytics::all(); // ini buat di tampilkan di master ( master bisa filter data)
        //$dataA (ditampilin di admin A)
        //$dataB (ditampilin di admin B)
        $totalbooks = books::where('store_id', 2)->count();

        $results = DB::select("SELECT COUNT(books.book_name) AS bookName, categories.category_name
            FROM books
            LEFT JOIN categories ON categories.id = books.category_id
            WHERE books.store_id = 2
            GROUP BY books.category_id, categories.category_name
        ");

        $data_books_categories_B = "";
        foreach ($results as $result) {
            $data_books_categories_B .= "['" . $result->category_name . "', " . $result->bookName . "],";
        }

        $pieChartData = $data_books_categories_B;
        return view("analytics.analyticsB", compact('totalbooks', 'pieChartData'));
    }
}
