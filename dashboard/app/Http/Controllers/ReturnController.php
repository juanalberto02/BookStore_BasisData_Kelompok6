<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\returns;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function showReturnPage()
    {
        $returns = returns::where('status', 1)->paginate(10);
    
        return view('return.return', compact('returns'));
    }
    

    public function showReturnAPage()
    {
        $returns = returns::with('books')->where('store_id', 1)->paginate(10);
        return view('return.returnA', compact('returns'));
    }

    public function createA()
    {
        $books = books::where('store_id', 1)->get(); // Retrieve books with store_id 2
        
        return view('return.addreturnA', compact('books'));
    }

    public function storeA(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'book_id' => 'required',
            'amount' => 'required',
            'reason' => 'required',
            'store_id' => 'required',
            'status' => 'required',
            // Add other validation rules as needed
        ]);

        // Create a new return record with the validated data
        returns::create($validatedData);

        // Redirect back to the returns list page with a success message
        return redirect()->route('returnA.showReturnAPage')->with('success', 'Return added successfully');
    }

    public function showReturnBPage()
    {
        $returns = returns::with('books')->where('store_id', 2)->paginate(10);

        return view('return.returnB', compact('returns'));
    }


    public function createB()
    {
        $books = books::where('store_id', 2)->get(); // Retrieve books with store_id 2
    
        return view('return.addreturnB', compact('books'));
    }
    

    public function storeB(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'book_id' => 'required',
            'amount' => 'required',
            'reason' => 'required',
            'store_id' => 'required',
            'status' => 'required',
            // Add other validation rules as needed
        ]);

        // Create a new return record with the validated data
        returns::create($validatedData);

        // Redirect back to the returns list page with a success message
        return redirect()->route('returnB.showReturnBPage')->with('success', 'Return added successfully');
    }

    public function accept(Request $request, $id)
    {
        $return = returns::findOrFail($id);
        $return->status = 2; // Set status to "2" for accepted
        $return->save();

        // You may add additional logic or redirect as needed
        return redirect()->back()->with('success', 'Return accepted successfully.');
    }

    public function reject(Request $request, $id)
    {
        $return = returns::findOrFail($id);
        $return->status = 3; // Set status to "3" for rejected
        $return->save();

        // You may add additional logic or redirect as needed
        return redirect()->back()->with('success', 'Return rejected successfully.');
    }
}
