<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet"
        href="assets/css/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="#">
                    {{-- <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div> --}}
                    <div class="sidebar-brand-text mx-3"><span>Analytics</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="/analytics"><i
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
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->name }}</span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/avatars/4.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity
                                            log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                            href="/logout"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        {{-- <h3 class="text-dark mb-4">Category</h3> --}}
                        @yield('header')
                    </div>
                    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-info">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}
                    <div class="card shadow">
                        <div class="card-header py-3">
                            {{-- <p class="text-primary m-0 fw-bold">Category Info</p> --}}
                            @yield('subheader')
                        </div>
                        <div class="card-body">
                            <div class="row">
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                {{-- <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @php
                                            $number = 1;
                                        @endphp

                                        @foreach ($data as $row)
                                        <tr>
                                            <th scope="row">{{$number++}}</th>
                                            <td>{{$row->category_name}}</td>
                                            <td>{{$row->description}}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-primary" href="/editcategories/{{ $row->id }}">
                                                        <i class="fa fa-pencil"></i> 
                                                        Edit 
                                                    </a>
                                                    <a href="/deletecategories/{{ $row->id }}" class="btn btn-danger"> 
                                                        <i class="fa fa-trash-o"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <strong>
                                                    ID
                                                </strong>
                                            </th>
                                            <th>
                                                <strong>
                                                    Category Name
                                                </strong>
                                            </th>
                                            <th>
                                                <strong>
                                                    Description
                                                </strong>
                                            </th>
                                            <th>
                                                <strong>
                                                    Action
                                                </strong>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table> --}}
                                @yield('table')
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-6 col-xl-1"
                                        style="margin-right: 26px;padding-right: 0px;padding-left: 0px;">
                                        {{-- <span>
                                            <a class="btn btn-primary d-block btn-user w-100" href="/addcategories"
                                                style="background: rgb(78,223,119);margin-left: 20px;margin-right: 20px;">
                                                <i
                                                    class="fa fa-plus"
                                                    style="font-size: 15px;margin-right: 2px;">
                                                </i>
                                                Add
                                            </a>
                                        </span> --}}
                                        @yield('add')
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"><span></span></div>
                                <div class="col-sm-6"><span></span></div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav
                                        class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" aria-label="Previous"
                                                    href="#"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span
                                                        aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div> --}}
                                @yield('pagination')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Kelompok 7</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

<script>
    @yield('script')
</script>

</html>
