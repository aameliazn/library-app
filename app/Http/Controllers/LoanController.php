<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function store(Request $request, $book)
    {
        $loanDate = Carbon::now()->toDateString();
        $dueDate = Carbon::createFromFormat('Y-m-d', $loanDate)->addDays(7)->toDateString();

        Loan::create([
            'userId' => Auth::user()->id,
            'bookId' => $book,
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
        $data['loans'] = Loan::all();

        date_default_timezone_set('Asia/Jakarta');
        $date = date('siHmd');

        $export = Pdf::loadView('export', $data);
        return $export->download('Book_Loan_Report_' . $date . '.pdf');
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
    public function update(Request $request, $loan)
    {
        $loan = Loan::findOrFail($loan);
        $loan->update(['status' => 'returned']);
        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
