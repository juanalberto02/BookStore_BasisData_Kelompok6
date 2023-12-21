@extends('layouts.booksform')

@section('form-input')
    <h3 class="text-dark mb-4">Edit Books</h3>
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="row mb-3 d-none">
                <div class="col">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                since last month</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5%
                                since last month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Books info</p>
                        </div>
                        <div class="card-body">
                            <form action="/updatebooks/{{$data->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for=""><strong>Book Category</strong></label>
                                        <select class="form-select mb-3" name="category_id"
                                            aria-label="Default select example">
                                            <option selected>Select Book Category</option>
                                            @foreach ($categoriesdata as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="username"><strong>Book Name</strong>
                                            </label>
                                            <input
                                                class="form-control" type="text" id="product-name"
                                                name="book_name" value="{{ $data->book_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label"
                                                for="username"><strong>Book
                                                    Description</strong></label><input
                                                class="form-control" type="text" id="product-name"
                                                name="book_description"
                                                value="{{ $data->book_description }}"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-outline">
                                        <label class="form-label" for="typeNumber"><strong>Book Stock A</strong></label>
                                        <input type="number" id="typeNumber" name="book_stock_A"
                                            value="{{ $data->book_stock }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-outline">
                                        <label class="form-label" for="typeNumber"><strong>Book Stock B</strong></label>
                                        <input type="number" id="typeNumber" name="book_stock_B"
                                            value="{{ $data->book_stock }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-outline">
                                        <label class="form-label" for="typeNumber"><strong>Book
                                                Price</strong></label>
                                        <input type="number" id="typeNumber" name="book_price"
                                            value="{{ $data->book_price }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for=""><strong>Store Location</strong></label>
                                        <select class="form-select mb-3" name="store_id"
                                            aria-label="Default select example">
                                            <option selected>Select Store Location</option>
                                            @foreach ($storesdata as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->store_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3"><button class="btn btn-primary btn-sm"
                                        type="submit"
                                        style="background: rgb(28,200,138);width: 68.0625px;height: 38.6px;font-size: 16px;">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection