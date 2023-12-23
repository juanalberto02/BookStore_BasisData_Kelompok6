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

        $combinedData = DB::connection('mysql_second')->table('fact_sales')
        ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
        ->join('dim_customers', 'fact_sales.sk_customers', '=', 'dim_customers.sk_customers')
        ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
        ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
        ->join('dim_times', 'fact_sales.sk_times', '=', 'dim_times.sk_times')
        ->select(
            'fact_sales.*', 
            'dim_books.book_name', 'dim_books.book_stock', 'dim_books.book_price', 'dim_books.category_name',
            'dim_customers.customer_name', 'dim_customers.email', 'dim_customers.phone', 'dim_customers.address',
            'dim_orders.order_id', 'dim_orders.order_detail_id', 'dim_orders.book_qty', 'dim_orders.subtotal',
            'dim_stores.store_name', 'dim_stores.store_region', 'dim_stores.store_address', 'dim_stores.store_id',
            'dim_times.day', 'dim_times.month_name', 'dim_times.year', 'dim_times.created_at'
        )
        ->get();

        $totalbooks = books::where('store_id', $selectedStore)->count();

        $totalorders = Order::where('store_id', $selectedStore)->count();

        $totalrevenue = DB::connection('mysql_second')
                        ->table('fact_sales')
                        ->where('sk_stores', $selectedStore)
                        ->sum('Revenue');

        $totalreturn = DB::connection('mysql')
                        ->table('returns')
                        ->where('store_id', $selectedStore)
                        ->count();
        
        // Filter the data based on the selected store_id
        $filteredData = $combinedData->where('store_id', $selectedStore);

        // Count 'customer_reguler' for the selected store
        $regulerCount = $filteredData->where('customer_name', 'Customer Reguler')->count();

        // Count other than 'customer_reguler' for the selected store
        $memberCount = $filteredData->where('customer_name', '!=', 'Customer Reguler')->count();

        // Group by month and count the orders for the selected store
        $orderCounts = $filteredData->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('M');
        })->sortKeys()->map(function ($monthData) {
            return count($monthData);
        });

        // Define the correct order of months
        $monthOrder = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        // Sort the months based on the defined order
        $orderCounts = $orderCounts->sortBy(function ($value, $key) use ($monthOrder) {
            return array_search($key, $monthOrder);
        });

        // Prepare data for the chart
        $chartData = [
            'labels' => $orderCounts->keys()->toArray(),
            'datasets' => [
                [
                    'label' => 'Orders',
                    'fill' => true,
                    'data' => $orderCounts->values()->toArray(),
                    'backgroundColor' => 'rgba(78, 115, 223, 0.05)',
                    'borderColor' => 'rgba(78, 115, 223, 1)',
                ],
            ],
        ];

        // Update chart configuration
        $chartOptions = [
            'maintainAspectRatio' => false,
            'legend' => [
                'display' => false,
                'labels' => [
                    'fontStyle' => 'normal',
                ],
            ],
            'title' => [
                'fontStyle' => 'normal',
            ],
            'scales' => [
                'xAxes' => [
                    [
                        'gridLines' => [
                            'color' => 'rgb(234, 236, 244)',
                            'zeroLineColor' => 'rgb(234, 236, 244)',
                            'drawBorder' => false,
                            'drawTicks' => false,
                            'borderDash' => ['2'],
                            'zeroLineBorderDash' => ['2'],
                            'drawOnChartArea' => false,
                        ],
                        'ticks' => [
                            'fontColor' => '#858796',
                            'fontStyle' => 'normal',
                            'padding' => 20,
                        ],
                    ],
                ],
                'yAxes' => [
                    [
                        'gridLines' => [
                            'color' => 'rgb(234, 236, 244)',
                            'zeroLineColor' => 'rgb(234, 236, 244)',
                            'drawBorder' => false,
                            'drawTicks' => false,
                            'borderDash' => ['2'],
                            'zeroLineBorderDash' => ['2'],
                        ],
                        'ticks' => [
                            'fontColor' => '#858796',
                            'fontStyle' => 'normal',
                            'padding' => 20,
                        ],
                    ],
                ],
            ],
        ];

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

        

        return view("analytics.analytics", compact('totalbooks', 'pieChartData','totalorders','totalrevenue', 'regulerCount', 'memberCount', 'totalreturn', 'chartData', 'chartOptions', 'selectedStore'));
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
