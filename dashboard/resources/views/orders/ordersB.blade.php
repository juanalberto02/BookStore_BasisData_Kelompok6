@extends('layouts.ordercustomer')

@section('title')
<title>Order Store B</title>
@endsection

@section('sidebar')
<nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
    <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-text mx-3"><span>Analytics</span></div> <!-- Perbaikan di sini, menghilangkan spasi ekstra -->
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item">
                <a class="nav-link" href="/analytics_store_B"><i class="far fa-chart-bar"></i><span>Analytics</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/books"><i class="far fa-list-alt"></i><span>Books</span></a>
                <a class="nav-link" href="/customersB"><i class="far fa-list-alt"></i><span>Customers</span></a>
                <a class="nav-link" href="/ordersB"><i class="far fa-list-alt"></i><span>Orders</span></a>
                <a class="nav-link" href="/orderlistB"><i class="far fa-list-alt"></i><span>Order List</span></a>
                <a class="nav-link" href="/returnB"><i class="far fa-list-alt"></i><span>Return Book</span></a>
            </li>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>
@endsection

@section('order')
<div class="container-fluid">
    <h3 class="text-dark mb-4">Order</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Order</p>
        </div>
        <div class="card-body">
            <section>
                <div class="container">
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card shadow-sm mb-2 db-graph">
                                <div class="card-header p-2">
                                    <h6 class="text-blue m-0 font-md">Add New Order</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('orderB.addB') }}">
                                        @csrf
                                        <input type="hidden" name="store_id" value="2">
                                        <div class="row">
                                            <div class="col-md-9 col-xl-12">
                                                <div class="box-bg">
                                                    <div class="row" style="margin-bottom: 16px;">
                                                        <div class="col-xl-3 col-xxl-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="customer_id"><strong>Customer ID</strong></label>
                                                                <select name="customer_id" class="form-select form-select-sm tbl-wfx kot-table font-sm">
                                                                    <option value="" selected>-- Select Customer --</option>
                                                                    @foreach($customers as $customer)
                                                                        @if ($customer->store_id == 2) {{-- Change '2' to the appropriate store_id for Store B --}}
                                                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-xl-2 offset-md-3 offset-xl-4 align-self-center">
                                                            <button class="btn btn-info btn-sm d-block add-row btn-xs w-100" type="button" style="background: rgb(1,185,225); color: white;">
                                                                <i class="fa fa-plus"></i><strong>&nbsp;Add Book</strong>
                                                            </button>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="table-responsive tbl-wfx mt-1 kot-table">
                                                        <table class="table table-sm" id="order-table">
                                                            <thead class="text-dark font-md">
                                                                <tr class="text-dark-blue">
                                                                    <th><strong>Book Name</strong></th>
                                                                    <th class="w-10x"><strong>Qty.</strong></th>
                                                                    <th class="w-10x"><strong>Sub Total</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="h-15x">
                                                                <tr>                                                                    
                                                                    <td>
                                                                        <div class="mb-1 form-group">
                                                                            <select name="order_details[0][book_id]" class="form-select form-select-sm tbl-wfx kot-table font-sm">
                                                                                <option value="" selected>-- Select Product --</option>
                                                                                @foreach($books as $book)
                                                                                    @if ($book->store_id == 2) {{-- Change '2' to the appropriate store_id for Store B --}}
                                                                                        <option value="{{ $book->id }}" data-book-price="{{ $book->book_price }}">{{ $book->book_name }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                            <input type="hidden" name="order_details[0][store_id]" value="2">
                                                                        </div>
                                                                    </td>
                                                                    <td class="w-10x">
                                                                        <div class="mb-1 form-group"><input name="order_details[0][book_qty]" class="form-control form-control-sm font-sm qty-input" type="number" step="1" min="1"></div>
                                                                    </td>
                                                                    <td class="w-10x">
                                                                        <div class="mb-1 form-group"><input class="form-control form-control-sm font-sm subtotal" type="text" name="order_details[0][subtotal]" disabled=""></div>
                                                                    </td>
                                                                    
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary d-block btn-user w-100" id="add-orders-button" style="background: rgb(78,223,119);">
                                            <i class="fa fa-plus" style="font-size: 15px; margin-right: 2px;"></i>Add Orders
                                        </button>
                                    </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <!-- Add Orders Button -->
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6"><span></span></div>
                    </div>
                </div>
                <div class="col-sm-6"><span></span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/Billing-Table-with-Add-Row--Fixed-Header-Feature-Billing-Table-with-Add-Row--Fixed-Header.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/js/theme.js"></script>
<script>
    $(document).ready(function() {
        // When the "Add Book" button is clicked
        $(".add-row").click(function() {
            var newRow = $("<tr>");
            var cols = "";

            var newIndex = $("#order-table tbody tr").length; // Get the current number of rows

            // Menambahkan indeks baru ke dalam nama elemen
            cols += '<td><div class="mb-1 form-group"><select name="order_details[' + newIndex + '][book_id]" class="form-select form-select-sm tbl-wfx kot-table font-sm">';
            cols += '<option value="" selected>-- Select Product --</option>';

            // Only include books from Store B (store_id = 2)
            @foreach($books as $book)
                @if ($book->store_id == 2)
                    cols += '<option value="{{ $book->id }}" data-book-price="{{ $book->book_price }}">{{ $book->book_name }}</option>';
                @endif
            @endforeach

            cols += '</select></div></td>';
            cols += '<td class="w-10x"><div class="mb-1 form-group"><input name="order_details[' + newIndex + '][book_qty]" class="form-control form-control-sm font-sm qty-input" type="number" step="1" min="1"></div></td>';
            cols += '<td class="w-10x"><div class="mb-1 form-group"><input class="form-control form-control-sm font-sm subtotal" type="text" name="order_details[' + newIndex + '][subtotal]" disabled></div></td>';

            newRow.append(cols);

            // Append the new row to the table
            $("#order-table").append(newRow);
        });

        // Function to calculate subtotal
        function calculateSubtotal(row) {
            var qty = parseFloat(row.find(".qty-input").val()) || 0;
            var bookPrice = parseFloat(row.find("select[name^='order_details'][name$='[book_id]'] option:selected").data("book-price")) || 0;
            var subtotal = qty * bookPrice;
            row.find(".subtotal").val(subtotal.toFixed(2));
        }

        // Calculate initial subtotal when the page loads
        $("#order-table tbody tr").each(function() {
            calculateSubtotal($(this));
        });

        // Calculate subtotal when quantity changes
        $("#order-table").on("input", ".qty-input", function() {
            calculateSubtotal($(this).closest("tr"));
        });
    });
</script>
@endsection