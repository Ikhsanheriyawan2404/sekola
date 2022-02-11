<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Classroom;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Study;
use App\Models\Teacher;
use Database\Seeders\ClassroomSeeder;
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
            // 'classroom' => Classroom::where('id', $id)->get(),
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

    public function store(ScheduleRequest $request)
    {
        $request->validated();

        Schedule::create([
            'day' => request('day'),
            'study_id' => request('study_id'),
            'room_id' => request('room_id'),
            'classroom_id' => request('classroom_id'),
            'start' => request('start'),
            'end' => request('end'),
        ]);

        toast('Data jadwal berhasil dibuat!','success');
        return redirect()->route('scheduls.index');
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', [
            'title' => 'Edit Jadwal',
            'schedule' => $schedule,
            'classrooms' => Classroom::all(),
            'rooms' => Room::all(),
            'studies' => Study::all(),
        ]);
    }

    public function update(ScheduleRequest $request,
                        Schedule $schedule)
    {
        $request->validated();

        $schedule->update([
            'day' => request('day'),
            'study_id' => request('study_id'),
            'room_id' => request('room_id'),
            'classroom_id' => request('classroom_id'),
            'start' => request('start'),
            'end' => request('end'),
        ]);

        toast('Data siswa berhasil diedit!','success');
        return redirect()->route('students.index');
    }
}
