<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $students = Room::latest()->get();
            return DataTables::of($students)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-center">

                           <a href="javascript:void(0)" data-id="' . $row->id . '" id="editRoom" class="btn btn-sm mr-2 btn-primary"><i class="fas fa-pencil-alt"></i></a>

                           <a href="javascript:void(0)" data-id="' . $row->id . '" id="deleteRoom" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('rooms.index', [
            'title' => 'Ruang',
        ]);
    }

    public function store()
    {
        request()->validate(['name' => 'required']);

        Room::updateOrCreate(
            ['id' => request('roomId')],
            ['name' => request('name')]);
    }

    public function edit(Room $room)
    {
        return response()->json($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
