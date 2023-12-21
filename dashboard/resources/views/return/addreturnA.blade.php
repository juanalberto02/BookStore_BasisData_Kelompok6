@extends('layouts.returnformA')

@section('form-input')
    <h3 class="text-dark mb-4">Add Return</h3>
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">New Return</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('returnA.storeA') }}" method="POST">
                                @csrf
                                <input type="hidden" name="store_id" value="1">
                                <input type="hidden" name="status" value="1">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="book_id"><strong>Select Book</strong></label>
                                            <select class="form-control" id="book_id" name="book_id">
                                                <!-- Assuming $books is the collection of books you want to display in the dropdown -->
                                                @foreach($books as $book)
                                                    <option value="{{ $book->id }}">{{ $book->book_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="amount"><strong>Amount</strong></label>
                                            <input class="form-control" type="number" id="amount" name="amount" min="1">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="reason"><strong>Reason</strong></label>
                                            <textarea class="form-control" id="reason" name="reason"></textarea>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mb-3">
                                    <button class="btn btn-primary btn-sm" type="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
