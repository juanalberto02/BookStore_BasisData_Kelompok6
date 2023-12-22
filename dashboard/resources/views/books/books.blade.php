@extends('layouts.main')

@section('header')
    <h3 class="text-dark mb-4">Book</h3>
@endsection

@section('subheader')
    <p class="text-primary m-0 fw-bold">Book Info</p>
@endsection

@section('filter')
    {{-- <div class="col-md-2 text-nowrap">
        <div id="dataTable_length" class="dataTables_length ms-5" aria-controls="dataTable">
            <label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                    <option value="10" selected="">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>&nbsp;</label>
        </div>
    </div>

    <div class="col-md-2 text-nowrap">
        <div id="dataTable_length" class="dataTables_length ms-5" aria-controls="dataTable">
            <label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                    <option value="10" selected="">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>&nbsp;</label>
        </div>
    </div> --}}

    <div class="col-6">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div id="dataTable_length" class="dataTables_length ms-2" aria-controls="dataTable">
                        <label class="form-label">Store&nbsp; 
                            <select class="d-inline-block form-select form-select-sm" name="store_id">
                                <option value="" {{ Request::get('store_id') == '' ? 'selected' : '' }}>Select Store</option>
                                <option value="1" {{ Request::get('store_id') == '1' ? 'selected' : '' }} selected="">A</option>
                                <option value="2" {{ Request::get('store_id') == '2' ? 'selected' : '' }}>B</option>
                            </select>&nbsp;
                        </label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div id="dataTable_length" class="dataTables_length ms-2" aria-controls="dataTable">
                        <label class="form-label">Genre&nbsp; 
                            <select class="d-inline-block form-select form-select-sm" name="category_id">
                                <option value="" {{Request::get('category_id') == '' ? 'selected':''}}>Select Category</option>
                                <option value="2" {{Request::get('category_id') == '2' ? 'selected':''}}>Science Fiction</option>
                                <option value="3" {{Request::get('category_id') == '3' ? 'selected':''}}>Fantasy</option>
                                <option value="4" {{Request::get('category_id') == '4' ? 'selected':''}}>Romance</option>
                                <option value="1" {{Request::get('category_id') == '1' ? 'selected':''}}>Mystery</option>
                                <option value="5" {{Request::get('category_id') == '5' ? 'selected':''}}>Non-Fiction</option>
                            </select>&nbsp;
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <br/>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('books') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-6 mt-4">
        <div class="text-md-end dataTables_filter" id="dataTable_filter">
            <form action="/books" method="GET">
                <label class="form-label">
                    <input type="search" name="search" class="form-control form-control-sm" aria-controls="dataTable"
                        placeholder="Search" value="{{ request('search') }}">
                </label>
            </form>
        </div>
    </div>
@endsection

@section('table')
    <table class="table my-0" id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                {{-- <th>Category ID</th> --}}
                <th>Category</th>
                <th>Book Name</th>
                <th>Book Description</th>
                <th>Book Stock</th>
                <th>Book Price</th>
                <th>Store Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @php
                $number = 1;
            @endphp

            @foreach ($data as $index => $row)
                {{-- @if ($row->stores->store_name === 'A') --}}
                <tr>
                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                    {{-- <td>{{ $row->category_id }}</td> --}}
                    <td>{{ $row->category->category_name }}</td>
                    <td>{{ $row->book_name }}</td>
                    <td>{{ $row->book_description }}</td>
                    <td>{{ $row->book_stock }}</td>
                    <td>{{ $row->book_price }}</td>
                    <td>{{ $row->stores->store_name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="/editbooks/{{ $row->id }}">
                                <i class="fa fa-pencil"></i>
                                Edit
                            </a>
                            {{-- href="/deletebooks/{{ $row->id }}" --}}
                            <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}"
                                data-nama="{{ $row->book_name }}">
                                <i class="fa fa-trash-o"></i>
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                {{-- @endif --}}
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <strong>
                        No
                    </strong>
                </th>
                <th>
                    <strong>
                        Category
                    </strong>
                </th>
                <th>
                    <strong>
                        Book Name
                    </strong>
                </th>
                <th>
                    <strong>
                        Book Description
                    </strong>
                </th>
                <th>
                    <strong>
                        Book Stock
                    </strong>
                </th>
                <th>
                    <strong>
                        Book Price
                    </strong>
                </th>
                <th>
                    <strong>
                        Store Name
                    </strong>
                </th>
                <th>
                    <strong>
                        Action
                    </strong>
                </th>
            </tr>
        </tfoot>
    </table>
@endsection

@section('add')
    <span>
        <a class="btn btn-primary d-block btn-user w-100" href="/addbooks"
            style="background: rgb(78,223,119);margin-left: 20px;margin-right: 20px;">
            <i class="fa fa-plus" style="font-size: 15px;margin-right: 2px;">
            </i>
            Add
        </a>
    </span>
@endsection


@section('pagination')
    {{-- <div class="col-md-6 align-self-center">
        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
            Showing 1 to 10 of 27</p>
    </div> --}}
    <div class="col mt-3">
        {{-- <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span
                            aria-hidden="true">«</span></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span
                            aria-hidden="true">»</span></a></li>
            </ul>
        </nav> --}}
        {{ $data->appends($_GET)->links('pagination::bootstrap-5') }}
        {{-- {{ $users->appends($_GET)->links() }} --}}
    </div>
@endsection

@section('script')
    $('.delete').click(function() {
    var booksid = $(this).attr('data-id');
    var booksname = $(this).attr('data-nama');
    Swal.fire({
    title: 'Apakah yakin untuk menghapus data ?',
    text: "Kamu akan menghapus data buku " + booksname + " ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
    window.location = "/deletebooks/" + booksid + " "
    Swal.fire(
    'Berhasil dihapus !',
    'Data buku ' + booksname + ' sudah dihapus',
    'success'
    )
    } else {
    Swal.fire(
    'Data tidak jadi dihapus',
    'Data buku ' + booksname + ' tidak jadi dihapus',
    'error'
    )
    }
    });
    });

    // Set a success toast, with a title
    @if (Session::has('success'))
        toastr.options.positionClass = 'toast-bottom-left';
        toastr.success("{{ Session::get('success') }}");
    @endif
@endsection
