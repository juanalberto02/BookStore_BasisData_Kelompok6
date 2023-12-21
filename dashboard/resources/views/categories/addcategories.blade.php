@extends('layouts.categoriesform')

@section('form-input')
    <h3 class="text-dark mb-4">Add Categories</h3>
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">New Categories</p>
                        </div>
                        <div class="card-body">
                            <form action="/insertcategories" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="username"><strong>Name</strong></label><input class="form-control" type="text" id="product-name" name="category_name"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                            <div class="mb-3"><label class="form-label" for="signature"><strong>Description</strong></label><textarea class="form-control" id="signature-1" rows="4" name="description"></textarea></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary btn-sm" type="submit" style="background: rgb(28,200,138);width: 68.0625px;height: 38.6px;font-size: 16px;margin-left: 20px;">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection