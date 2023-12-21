@extends('layouts.returnssA')

@section('header')
    <h3 class="text-dark mb-4">Return</h3>
@endsection

@section('subheader')
    <p class="text-primary m-0 fw-bold">Return Info</p>
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
                <th>Book Name</th>
                <th>Book Description</th>
                <th>Amount</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returns as $index => $row)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $row->books->book_name }}</td>
                    <td>{{ $row->books->book_description }}</td>
                    <td>{{ $row->amount }}</td>
                    <td>{{ $row->reason }}</td>
                    <td>
                        @if($row->status == 1)
                            Terkirim
                        @elseif($row->status == 2)
                            Diterima
                        @elseif($row->status == 3)
                            Ditolak
                        @else
                            <!-- Add alternative status display if needed -->
                            {{ $row->status }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <strong>No</strong>
                </th>
                <th>
                    <strong>Book Name</strong>
                </th>
                <th>
                    <strong>Book Description</strong>
                </th>
                <th>
                    <strong>Amount</strong>
                </th>
                <th>
                    <strong>Reason</strong>
                </th>
                <th>
                    <strong>Status</strong>
                </th>
            </tr>
        </tfoot>
    </table>
@endsection

@section('add')
    <span>
        <a class="btn btn-primary d-block btn-user w-100" href="/addreturnA"
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
        {{ $returns->appends($_GET)->links('pagination::bootstrap-5') }}

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
