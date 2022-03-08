<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Exports\FinanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:finance-list|finance-create|finance-edit|finance-delete', ['only' => ['index','show']]);
        $this->middleware('permission:finance-create', ['only' => ['create','store']]);
        $this->middleware('permission:finance-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:finance-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $finances = Finance::all();
            return DataTables::of($finances)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return date('d-m-Y', strtotime($request->created_at));
                })
                ->addColumn('action', function($row){
                    $btn =
                        '<div class="d-flex justify-content-center">

                        <form action=" ' . route('finances.destroy', $row->id) . '" method="POST">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah yakin ingin menghapus ini?\')"><i class="fas fa-trash"></i></button>
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        </form>

                        </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('finances.index', [
            'finances' => Finance::all(),
            'title' => 'Data Keuangan',
        ]);
    }

    public function create_cash_in()
    {
        return view('finances.cash_in.create', [
            'title' => 'Tambah Pemasukan',
        ]);
    }

    public function create_cash_out()
    {
        return view('finances.cash_out.create', [
            'title' => 'Tambah Pengeluaran',
        ]);
    }

    public function store_cash_in()
    {
        Finance::create([
            'name' => request('name'),
            'cash_in' => strtok(str_replace(".", "", request('cash_in')), "Rp "),
            'description' => request('description'),
        ]);

        toast('Cash pemasukan berhasil dibuat!', 'success');
        return redirect()->route('finances.index');
    }

    public function store_cash_out()
    {
        Finance::create([
            'name' => request('name'),
            'cash_out' => strtok(str_replace(".", "", request('cash_out')), "Rp "),
            'description' => request('description'),
        ]);

        toast('Cash pengeluaran berhasil dibuat!', 'success');
        return redirect()->route('finances.index');
    }

    // public function edit_cash_in(Finance $finance)
    // {
    //     return view('finances.cash_in.edit')
    // }

    public function destroy(Finance $finance)
    {
        $finance->delete();

        toast('Data keuangan berhasil dihapus!', 'success');
        return redirect()->route('finances.index');
    }

    public function export()
    {
        return Excel::download(new FinanceExport, time() . 'keuangan.xlsx');
    }

    public function print()
    {
        $finances = Finance::all();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('finances.pdf', compact('finances'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }


}
