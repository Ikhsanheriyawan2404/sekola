<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:setting-list|setting-edit', ['only' => ['index','show']]);
        $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
    }
    public function index()
    {
        return view('settings.index', [
            'title' => 'Info Sekolah',
            'settings' => Setting::all(),
        ]);
    }

    public function update(Setting $setting)
    {
        request()->validate([
            'school_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'type' => 'required',
            'address' => 'required',
        ]);

        if (request('image')) {
            Storage::delete($setting->image);
            $image = request()->file('image')->store('img/school');
        } elseif ($setting->image) {
            $image = $setting->image;
        } else {
            $image = null;
        }

        $setting->update([
            'school_name' => request('school_name'),
            'image' => $image,
            'phone' => request('phone'),
            'email' => request('email'),
            'type' => request('type'),
            'address' => request('address'),
        ]);

        toast('Data sekolah berhasil diupdate!', 'success');
        return redirect()->back();
    }
}
