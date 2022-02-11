<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Study;
use App\Models\Teacher;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $classrooms = Classroom::latest()->get();
            return DataTables::of($classrooms)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-center">
                            <a href="javascript:void(0)" data-id="'.$row->id.'" id="showSchedule" class="btn btn-sm btn-primary mr-2">
                            <i class="fas fa-eye"></i>
                            Jadwal
                            </a>
                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('schedules.index', [
            'title' => 'Jadwal',
        ]);
    }

    public function create()
    {
        return view('schedules.create', [
            'title' => 'Tamvah Jadwal',
            'schedule' => new Schedule(),
            'classrooms' => Classroom::all(),
            'teachers' => Teacher::all(),
            'studies' => Study::all(),
        ]);
    }

    public function store(ScheduleRequest $request)
    {
        Schedule::create([

        ]);
    }
}
