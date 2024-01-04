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
        //$selectedStore = $request->input('store', 1); // Default to store_id 1 if no selection is made
        $selectedStore = $request->input('store', 'all'); // Default to store_id 1 if no selection is made

        $combinedData = DB::connection('mysql_second')->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_customers', 'fact_sales.sk_customers', '=', 'dim_customers.sk_customers')
            ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
            ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
            ->join('dim_times', 'fact_sales.sk_times', '=', 'dim_times.sk_times')
            ->select(
                'fact_sales.*',
                'dim_books.book_name',
                'dim_books.book_stock',
                'dim_books.book_price',
                'dim_books.category_name',
                'dim_customers.customer_name',
                'dim_customers.email',
                'dim_customers.phone',
                'dim_customers.address',
                'dim_orders.order_id',
                'dim_orders.order_detail_id',
                'dim_orders.book_qty',
                'dim_orders.subtotal',
                'dim_stores.store_name',
                'dim_stores.store_region',
                'dim_stores.store_address',
                'dim_stores.store_id',
                'dim_times.day',
                'dim_times.month_name',
                'dim_times.year',
                'dim_times.created_at'
            )
            ->get();

        if ($selectedStore == 'all') {
            // Aggregate data from all stores
            $totalbooks = books::count();
            $totalorders = Order::count();
            $totalrevenue = DB::connection('mysql_second')->table('fact_sales')->sum('Revenue');
            $totalreturn = DB::connection('mysql')->table('returns')->count();
            $filteredData = $combinedData;

            // Count 'customer_reguler' for the selected store
            $regulerCount = $filteredData->where('customer_name', 'Customer Reguler')->count();

        // Count other than 'customer_reguler' for the selected store
            $memberCount = $filteredData->where('customer_name', '!=', 'Customer Reguler')->count();

            $results = DB::select("SELECT COUNT(books.book_name) AS bookName, categories.category_name
            FROM books
            LEFT JOIN categories ON categories.id = books.category_id
            GROUP BY books.category_id, categories.category_name");



           // Mendapatkan data jumlah revenue per kategori
            $categoryRevenueData = DB::connection('mysql_second')
                ->table('fact_sales')
                ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
                ->selectRaw('SUM(fact_sales.Revenue) as revenue, dim_books.category_name')
                ->groupBy('dim_books.category_name')
                ->get();

           // Konversi data menjadi format yang sesuai untuk chart
           $pieChartDataRevenue = $categoryRevenueData->map(function ($item) {
           return [
               'value' => $item->revenue,
               'name' => $item->category_name,
           ];
           });

           // Convert $pieChartDataRevenue to JSON
           $pieChartDataRevenueJson = $pieChartDataRevenue->toJson();

           $categoryOrderSumData = DB::connection('mysql_second')
            ->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
            ->selectRaw('SUM(dim_orders.book_qty) as total_book_qty, dim_books.category_name')
            ->groupBy('dim_books.category_name')
            ->get();

            $categorySum = $categoryOrderSumData->map(function ($item) {
            return [
                'value' => $item->total_book_qty,
                'groupId' => $item->category_name,
            ];
            });

            // Convert $categorySum to JSON
            $categorySumJson = json_encode($categorySum);

            $scienceFictionSalesData = $combinedData
                ->where('category_name', 'Science Fiction')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();  

            $romanceSalesData = $combinedData
                ->where('category_name', 'Romance')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();  
            
            $fantasySalesData = $combinedData
                ->where('category_name', 'Fantasy')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();
            
            $nonFictionSalesData = $combinedData
                ->where('category_name', 'Non-Fiction')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();
            
            $mysterySalesData = $combinedData
                ->where('category_name', 'Mystery')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();


            // Convert $scienceFictionSalesData to JSON
            $scienceFictionSalesJson = json_encode($scienceFictionSalesData);
            $romanceSalesJson = json_encode($romanceSalesData);
            $fantasySalesJson = json_encode($fantasySalesData);
            $nonFictionSalesJson = json_encode($nonFictionSalesData);
            $mysterySalesJson = json_encode($mysterySalesData);

            // Dump the contents of $scienceFictionSalesJson and stop the script execution
            //dd($categoryCount);


        } else {
            // Existing logic for individual stores
            $totalbooks = books::where('store_id', $selectedStore)->count();
            $totalorders = Order::where('store_id', $selectedStore)->count();
            $totalrevenue = DB::connection('mysql_second')->table('fact_sales')->where('sk_stores', $selectedStore)->sum('Revenue');
            $totalreturn = DB::connection('mysql')->table('returns')->where('store_id', $selectedStore)->count();
            $filteredData = $combinedData->where('store_id', $selectedStore);

            // Count 'customer_reguler' for the selected store
            $regulerCount = $filteredData->where('customer_name', 'Customer Reguler')->count();

            // Count other than 'customer_reguler' for the selected store
            $memberCount = $filteredData->where('customer_name', '!=', 'Customer Reguler')->count();

            $results = DB::select("SELECT COUNT(books.book_name) AS bookName, categories.category_name
            FROM books
            LEFT JOIN categories ON categories.id = books.category_id
            WHERE books.store_id = $selectedStore
            GROUP BY books.category_id, categories.category_name");

            //$selectedStore = 1; // Gantilah dengan nilai toko yang sesuai

            $categoryRevenueData = DB::connection('mysql_second')
                ->table('fact_sales')
                ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
                ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
                ->selectRaw('SUM(fact_sales.Revenue) as revenue, dim_books.category_name')
                ->where('dim_stores.store_id', $selectedStore)
                ->groupBy('dim_books.category_name')
                ->get();

            $pieChartDataRevenue = $categoryRevenueData->map(function ($item) {
                return [
                    'value' => $item->revenue,
                    'name' => $item->category_name,
                ];
            });

            $pieChartDataRevenueJson = $pieChartDataRevenue->toJson();

            $categoryOrderSumData = DB::connection('mysql_second')
                ->table('fact_sales')
                ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
                ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
                ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
                ->selectRaw('SUM(dim_orders.book_qty) as total_book_qty, dim_books.category_name')
                ->where('dim_stores.store_id', $selectedStore)
                ->groupBy('dim_books.category_name')
                ->get();

            $categorySum = $categoryOrderSumData->map(function ($item) {
                return [
                    'value' => $item->total_book_qty,
                    'groupId' => $item->category_name,
                ];
            });

            $categorySumJson = $categorySum->toJson();

            $scienceFictionSalesData = $combinedData
                ->where('store_id', $selectedStore)
                ->where('category_name', 'Science Fiction')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();  

            $romanceSalesData = $combinedData
                ->where('store_id', $selectedStore)
                ->where('category_name', 'Romance')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();  
                
            $fantasySalesData = $combinedData
                ->where('store_id', $selectedStore)
                ->where('category_name', 'Fantasy')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();
                
            $nonFictionSalesData = $combinedData
                ->where('store_id', $selectedStore)
                ->where('category_name', 'Non-Fiction')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();
                
            $mysterySalesData = $combinedData
                ->where('store_id', $selectedStore)
                ->where('category_name', 'Mystery')
                ->groupBy('book_name')
                ->map(function ($salesData, $bookName) {
                    return [$bookName, $salesData->sum('book_qty')];
                })
                ->values()
                ->toArray();


            // Convert $scienceFictionSalesData to JSON
            $scienceFictionSalesJson = json_encode($scienceFictionSalesData);
            $romanceSalesJson = json_encode($romanceSalesData);
            $fantasySalesJson = json_encode($fantasySalesData);
            $nonFictionSalesJson = json_encode($nonFictionSalesData);
            $mysterySalesJson = json_encode($mysterySalesData);
            
        }

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

        $data_books_categories = [];
        foreach ($results as $result) {
            $data_books_categories[] = [
                'name' => $result->category_name,
                'value' => $result->bookName
            ];
        }

        $pieChartData = $data_books_categories;


        return view("analytics.analytics", compact('totalbooks','pieChartDataRevenueJson', 'pieChartData', 'totalorders', 'totalrevenue', 'regulerCount', 'memberCount', 'totalreturn', 'chartData', 'chartOptions', 'selectedStore', 'categorySumJson', 'scienceFictionSalesJson', 'romanceSalesJson', 'fantasySalesJson', 'nonFictionSalesJson', 'mysterySalesJson'));


    }


    public function analyticsA()
    {
        $combinedData = DB::connection('mysql_second')->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_customers', 'fact_sales.sk_customers', '=', 'dim_customers.sk_customers')
            ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
            ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
            ->join('dim_times', 'fact_sales.sk_times', '=', 'dim_times.sk_times')
            ->select(
                'fact_sales.*',
                'dim_books.book_name',
                'dim_books.book_stock',
                'dim_books.book_price',
                'dim_books.category_name',
                'dim_customers.customer_name',
                'dim_customers.email',
                'dim_customers.phone',
                'dim_customers.address',
                'dim_orders.order_id',
                'dim_orders.order_detail_id',
                'dim_orders.book_qty',
                'dim_orders.subtotal',
                'dim_stores.store_name',
                'dim_stores.store_region',
                'dim_stores.store_address',
                'dim_stores.store_id',
                'dim_times.day',
                'dim_times.month_name',
                'dim_times.year',
                'dim_times.created_at'
            )
            ->get();

        $totalbooks = books::where('store_id', 1)->count();
        // $totalorders = DB::select('SELECT COUNT(orders_details.order_id)');
        $totalorders = Order::where('store_id', 1)->count();

        $totalrevenue = DB::connection('mysql_second')
            ->table('fact_sales')
            ->where('sk_stores', 1)
            ->sum('Revenue');

        $totalreturn = DB::connection('mysql')
            ->table('returns')
            ->where('store_id', 1)
            ->count();

        // Filter the data based on the selected store_id
        $filteredData = $combinedData->where('store_id', 1);

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
            WHERE books.store_id = 1
            GROUP BY books.category_id, categories.category_name
        ");

        $data_books_categories_A = [];
        foreach ($results as $result) {
            $data_books_categories_A[] = [
                'name' => $result->category_name,
                'value' => $result->bookName
            ];
        }

        $pieChartData = $data_books_categories_A;

        //$selectedStore = 1; // Gantilah dengan nilai toko yang sesuai

        $categoryRevenueData = DB::connection('mysql_second')
            ->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
            ->selectRaw('SUM(fact_sales.Revenue) as revenue, dim_books.category_name')
            ->where('dim_stores.store_id', 1)
            ->groupBy('dim_books.category_name')
            ->get();

        $pieChartDataRevenue = $categoryRevenueData->map(function ($item) {
            return [
                'value' => $item->revenue,
                'name' => $item->category_name,
            ];
        });

        $pieChartDataRevenueJson = $pieChartDataRevenue->toJson();

        $categoryOrderSumData = DB::connection('mysql_second')
            ->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
            ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
            ->selectRaw('SUM(dim_orders.book_qty) as total_book_qty, dim_books.category_name')
            ->where('dim_stores.store_id', 1)
            ->groupBy('dim_books.category_name')
            ->get();

        $categorySum = $categoryOrderSumData->map(function ($item) {
            return [
                'value' => $item->total_book_qty,
                'groupId' => $item->category_name,
            ];
        });

        $categorySumJson = $categorySum->toJson();

        $scienceFictionSalesData = $combinedData
            ->where('store_id', 1)
            ->where('category_name', 'Science Fiction')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();  

        $romanceSalesData = $combinedData
            ->where('store_id', 1)
            ->where('category_name', 'Romance')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();  
            
        $fantasySalesData = $combinedData
            ->where('store_id', 1)
            ->where('category_name', 'Fantasy')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();
            
        $nonFictionSalesData = $combinedData
            ->where('store_id', 1)
            ->where('category_name', 'Non-Fiction')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();
            
        $mysterySalesData = $combinedData
            ->where('store_id', 1)
            ->where('category_name', 'Mystery')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();


        // Convert $scienceFictionSalesData to JSON
        $scienceFictionSalesJson = json_encode($scienceFictionSalesData);
        $romanceSalesJson = json_encode($romanceSalesData);
        $fantasySalesJson = json_encode($fantasySalesData);
        $nonFictionSalesJson = json_encode($nonFictionSalesData);
        $mysterySalesJson = json_encode($mysterySalesData);
        

        return view("analytics.analyticsA", compact('totalbooks','pieChartDataRevenueJson', 'pieChartData', 'totalorders', 'totalrevenue', 'regulerCount', 'memberCount', 'totalreturn', 'chartData', 'chartOptions', 'categorySumJson', 'scienceFictionSalesJson', 'romanceSalesJson', 'fantasySalesJson', 'nonFictionSalesJson', 'mysterySalesJson'));
    }

    public function analyticsB()
    {
        $combinedData = DB::connection('mysql_second')->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_customers', 'fact_sales.sk_customers', '=', 'dim_customers.sk_customers')
            ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
            ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
            ->join('dim_times', 'fact_sales.sk_times', '=', 'dim_times.sk_times')
            ->select(
                'fact_sales.*',
                'dim_books.book_name',
                'dim_books.book_stock',
                'dim_books.book_price',
                'dim_books.category_name',
                'dim_customers.customer_name',
                'dim_customers.email',
                'dim_customers.phone',
                'dim_customers.address',
                'dim_orders.order_id',
                'dim_orders.order_detail_id',
                'dim_orders.book_qty',
                'dim_orders.subtotal',
                'dim_stores.store_name',
                'dim_stores.store_region',
                'dim_stores.store_address',
                'dim_stores.store_id',
                'dim_times.day',
                'dim_times.month_name',
                'dim_times.year',
                'dim_times.created_at'
            )
            ->get();

        $totalbooks = books::where('store_id', 2)->count();
        // $totalorders = DB::select('SELECT COUNT(orders_details.order_id)');
        $totalorders = Order::where('store_id', 2)->count();

        $totalrevenue = DB::connection('mysql_second')
            ->table('fact_sales')
            ->where('sk_stores', 2)
            ->sum('Revenue');

        $totalreturn = DB::connection('mysql')
            ->table('returns')
            ->where('store_id', 2)
            ->count();

        // Filter the data based on the selected store_id
        $filteredData = $combinedData->where('store_id', 2);

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
            WHERE books.store_id = 2
            GROUP BY books.category_id, categories.category_name
        ");

        $data_books_categories_B = [];
        foreach ($results as $result) {
            $data_books_categories_B[] = [
                'name' => $result->category_name,
                'value' => $result->bookName
            ];
        }

        $pieChartData = $data_books_categories_B;

        //$selectedStore = 2; // Gantilah dengan nilai toko yang sesuai

        $categoryRevenueData = DB::connection('mysql_second')
            ->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
            ->selectRaw('SUM(fact_sales.Revenue) as revenue, dim_books.category_name')
            ->where('dim_stores.store_id', 2)
            ->groupBy('dim_books.category_name')
            ->get();

        $pieChartDataRevenue = $categoryRevenueData->map(function ($item) {
            return [
                'value' => $item->revenue,
                'name' => $item->category_name,
            ];
        });

        $pieChartDataRevenueJson = $pieChartDataRevenue->toJson();

        $categoryOrderSumData = DB::connection('mysql_second')
            ->table('fact_sales')
            ->join('dim_books', 'fact_sales.sk_books', '=', 'dim_books.sk_books')
            ->join('dim_orders', 'fact_sales.sk_order', '=', 'dim_orders.sk_order')
            ->join('dim_stores', 'fact_sales.sk_stores', '=', 'dim_stores.sk_stores')
            ->selectRaw('SUM(dim_orders.book_qty) as total_book_qty, dim_books.category_name')
            ->where('dim_stores.store_id', 2)
            ->groupBy('dim_books.category_name')
            ->get();

        $categorySum = $categoryOrderSumData->map(function ($item) {
            return [
                'value' => $item->total_book_qty,
                'groupId' => $item->category_name,
            ];
        });

        $categorySumJson = $categorySum->toJson();

        $scienceFictionSalesData = $combinedData
            ->where('store_id', 2)
            ->where('category_name', 'Science Fiction')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();  

        $romanceSalesData = $combinedData
            ->where('store_id', 2)
            ->where('category_name', 'Romance')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();  
            
        $fantasySalesData = $combinedData
            ->where('store_id', 2)
            ->where('category_name', 'Fantasy')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();
            
        $nonFictionSalesData = $combinedData
            ->where('store_id', 2)
            ->where('category_name', 'Non-Fiction')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();
            
        $mysterySalesData = $combinedData
            ->where('store_id', 2)
            ->where('category_name', 'Mystery')
            ->groupBy('book_name')
            ->map(function ($salesData, $bookName) {
                return [$bookName, $salesData->sum('book_qty')];
            })
            ->values()
            ->toArray();


        // Convert $scienceFictionSalesData to JSON
        $scienceFictionSalesJson = json_encode($scienceFictionSalesData);
        $romanceSalesJson = json_encode($romanceSalesData);
        $fantasySalesJson = json_encode($fantasySalesData);
        $nonFictionSalesJson = json_encode($nonFictionSalesData);
        $mysterySalesJson = json_encode($mysterySalesData);

        return view("analytics.analyticsB", compact('totalbooks','pieChartDataRevenueJson', 'pieChartData', 'totalorders', 'totalrevenue', 'regulerCount', 'memberCount', 'totalreturn', 'chartData', 'chartOptions', 'categorySumJson', 'scienceFictionSalesJson', 'romanceSalesJson', 'fantasySalesJson', 'nonFictionSalesJson', 'mysterySalesJson'));
    }
}
