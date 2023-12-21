<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="{{ asset("bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{ asset("fonts/fontawesome-all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css") }}">
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
                    <li class="nav-item"><a class="nav-link" href="analytics.html"><i class="far fa-chart-bar"></i><span>Analytics</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/books"><i class="far fa-list-alt"></i><span>Books</span></a>
                        <a class="nav-link" href="/customersB"><i class="fas fa-table"></i><span>Customers</span></a>
                        <a class="nav-link" href="/ordersB"><i class="far fa-list-alt"></i><span>Orders</span></a>
                        <a class="nav-link" href="/orderlistB"><i class="far fa-list-alt"></i><span>Order List</span></a>
                        <a class="nav-link" href="/returnB"><i class="far fa-list-alt"></i><span>Return Book</span></a>
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
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/avatars/4.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    {{-- <h3 class="text-dark mb-4">Add Customer</h3>
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">New Customer</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="/insertcustomers" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Name</strong></label><input class="form-control" type="text" id="product-name" name="customer_name"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                            <div class="mb-3"><label class="form-label" for="signature"><strong>Description</strong></label><textarea class="form-control" id="signature-1" rows="4" name="description"></textarea></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" style="background: rgb(28,200,138);width: 68.0625px;height: 38.6px;font-size: 16px;">Add</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @yield('form-input')
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="{{ asset("bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("js/bs-init.js") }}"></script> 
    <script src="{{ asset("js/theme.js") }}"></script>
</body>

</html>