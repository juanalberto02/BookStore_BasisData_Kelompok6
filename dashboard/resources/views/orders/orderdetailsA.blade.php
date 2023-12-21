<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>

    <!-- Link to Bootstrap CSS from Laravel public assets -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <!-- Link to Google Fonts (Nunito) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">

    <!-- Custom CSS for your page -->
    <link rel="stylesheet" href="{{ asset('assets/css/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css') }}">

    <!-- SweetAlert2 CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
            </a>
            <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="/analytics_store_A"><i
                                class="far fa-chart-bar"></i><span>Analytics</span></a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/books_store_A"><i class="far fa-list-alt"></i><span>Books</span></a>
                        <a class="nav-link" href="/customersA"><i class="fas fa-table"></i><span>Customers</span></a>
                        <a class="nav-link" href="/ordersA"><i class="far fa-list-alt"></i><span>Orders</span></a>
                        <a class="nav-link" href="/orderlistA"><i class="far fa-list-alt"></i><span>Order List</span></a>
                        <a class="nav-link" href="/returnA"><i class="far fa-list-alt"></i><span>Return Book</span></a>
                    </li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{Auth::user()->name}}</span><img class="border rounded-circle img-profile" src="assets/img/avatars/4.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Order Details</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Product Info</p>
                        </div>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold"></p>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Order ID</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->id }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Name</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->customer->customer_name }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Customer ID</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->customer_id }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Email</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->customer->email }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Order Date</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->order_date }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Phone</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->customer->phone }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Store ID</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->store_id }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);font-weight: bold;">Address</span><span style="color: rgb(0,0,0);margin-left: 22px;">{{ $order->customer->address }}</span></div>
                                        <div class="col-sm-6"><span style="color: rgb(0,0,0);margin-left: 22px;"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Book Name</th>
                                            <th>Book Category</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderDetails as $detail)
                                            <tr>
                                                <td>{{ $detail->id }}</td>
                                                <td>{{ $detail->book->book_name }}</td>
                                                <td>{{ $detail->book->category->category_name }}</td>
                                                <td>{{ $detail->book->book_price }}</td>
                                                <td>{{ $detail->book_qty }}</td>
                                                <td>{{ $detail->book_qty * $detail->book->book_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Total Amount</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>${{ $totalAmount }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-6 col-xl-1" style="margin-right: 26px;padding-right: 0px;padding-left: 0px;"><span></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"><span></span></div>
                                <div class="col-sm-6"><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Billing-Table-with-Add-Row--Fixed-Header-Feature-Billing-Table-with-Add-Row--Fixed-Header.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>