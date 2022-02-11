<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Classroom;
use App\Models\Room;
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
                            <a href="' . route('schedules.show', $row->id) . '" class="btn btn-sm btn-primary mr-2">
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

    public function show($id)
    {
        return view('schedules.show', [
            'title' => 'Data Jadwal',
            // 'classroom' => $classroom,
            'schedules' => Schedule::where('classroom_id', $id)->get(),
        ]);
    }

    public function create()
    {
        return view('schedules.create', [
            'title' => 'Tamvah Jadwal',
            'schedule' => new Schedule(),
            'classrooms' => Classroom::all(),
            'rooms' => Room::all(),
            'studies' => Study::all(),
        ]);
    }

    public function store()
    {
        return $schedule = [
            'day' => request('day'),
            'study_id' => request('study_id'),
            'room_id' => request('room_id'),
            'classroom_id' => request('classroom_id'),
            'start' => request('start'),
            'end' => request('end'),
        ];
        // dd($schedule);
    }
}
