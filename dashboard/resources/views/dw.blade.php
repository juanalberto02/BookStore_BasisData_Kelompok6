{{-- <!DOCTYPE html>
<html>
<head>
    <title>Fact Sales Data</title>
</head>
<body>
    <h1>Data from Fact Sales</h1>
    <table>
        <tr>
            <th>SK Times</th>
            <th>SK Order</th>
            <th>SK Customers</th>
            <th>SK Books</th>
            <th>SK Stores</th>
            <th>Total Stock</th>
            <th>Revenue</th>
        </tr>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->sk_times }}</td>
                <td>{{ $item->sk_order }}</td>
                <td>{{ $item->sk_customers }}</td>
                <td>{{ $item->sk_books }}</td>
                <td>{{ $item->sk_stores }}</td>
                <td>{{ $item->Total_Stock }}</td>
                <td>{{ $item->Revenue }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Combined Data View</title>
</head>
<body>
    <h1>Combined Data from Multiple Tables</h1>
    <table>
        <!-- Table Headers -->
        <tr>
            <th>day</th>
            <th>month_name</th>
            <th>year</th>
            <th>customer type</th>
            <th>Order id</th>
            <th>Order detail id</th>
            <th>Order Quantity</th>
            <th>Subtotal</th>
            <th>Store Name</th>
            <th>Region</th>
            <!-- Add other headers as needed -->
        </tr>

        <!-- Table Data -->
        @foreach($combinedData as $data)
        <tr>
            <td>{{ $data->day }}</td>
            <td>{{ $data->month_name }}</td>
            <td>{{ $data->year }}</td>
            <td>{{ $data->customer_name }}</td>
            <td>{{ $data->order_id}}</td>
            <td>{{ $data->order_detail_id}}</td>
            <td>{{ $data->book_qty}}</td>
            <td>{{ $data->subtotal}}</td>
            <td>{{ $data->store_region}}</td>
            <!-- Add other data columns as needed -->
        </tr>
        @endforeach
    </table>
</body>
</html>
