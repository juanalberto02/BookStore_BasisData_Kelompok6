@extends('layouts.analyticstemplate')

@section('sidebar')
    <li class="nav-item"><a class="nav-link" href="/analytics"><i class="far fa-chart-bar"></i><span>Analytics</span></a></li>
    <li class="nav-item">
        <a class="nav-link" href="/books"><i class="far fa-list-alt"></i><span>Books</span></a>
        <a class="nav-link" href="/categories"><i class="far fa-list-alt"></i><span>Category</span></a>
        <a class="nav-link" href="/return"><i class="far fa-list-alt"></i><span>Return Book</span></a>
    </li>
    <li class="nav-item"></li>
    <li class="nav-item"></li>
@endsection

@section('content')
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Dashboard Analytics</h3>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body" style="height: 200px;">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <form action="{{ route('analytics.filter') }}" method="GET" class="form-inline">
                                <div class="form-group" style="margin-bottom: 60px;">
                                    <label for="store" class="mr-2 mb-2">Select Store:</label>
                                    <select name="store" id="store" class="form-control mb-2">
                                        <option value="all" {{ request('store') == 'all' ? 'selected' : '' }}>All Stores</option>
                                        <option value="1" {{ request('store') == 1 ? 'selected' : '' }}>Store A</option>
                                        <option value="2" {{ request('store') == 2 ? 'selected' : '' }}>Store B</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary ml-2">Apply Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-8 mb-4">
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Books</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>{{ $totalbooks }}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Order</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>{{ $totalorders }}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Revenue</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>{{ $totalrevenue }}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Reguler</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>{{ $regulerCount }}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Member</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>{{ $memberCount }}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Return</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>{{ $totalreturn }}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-7">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Monthly Order</h6>
                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false"
                            data-bs-toggle="dropdown" type="button"><i
                                class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item"
                                href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another
                                action</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else
                                here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas data-bss-chart="{{ json_encode(['type' => 'line', 'data' => $chartData, 'options' => $chartOptions]) }}"></canvas>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-5">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Books Genre</h6>
                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle"
                            aria-expanded="false" data-bs-toggle="dropdown" type="button"><i
                                class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item"
                                href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another
                                action</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something
                                else
                                here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="piechart" style="width: 110%; height: 320px;margin-left:-5%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-5">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Revenue per Category</h6>
                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle"
                            aria-expanded="false" data-bs-toggle="dropdown" type="button"><i
                                class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item"
                                href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another
                                action</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something
                                else
                                here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="category-revenue" style="width: 110%; height: 320px;margin-left:-5%"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-7">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary fw-bold m-0">Total Orders per Category</h6>
                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false"
                            data-bs-toggle="dropdown" type="button"><i
                                class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item"
                                href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another
                                action</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else
                                here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <div id="chart-categories" style="width: 100%; height: 350px;"></div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection
