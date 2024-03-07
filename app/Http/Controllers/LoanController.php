<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $bookId)
    {
        $loanDate = Carbon::now()->toDateString();
        $dueDate = Carbon::createFromFormat('Y-m-d', $loanDate)->addDays(7)->toDateString();

        Loan::create([
            'userId' => Auth::user()->id,
            'bookId' => $bookId,
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'status' => 'outstanding',
        ]);

        return back()->with('success', 'Berhasil meminjam buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
