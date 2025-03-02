<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Log;
use App\Models\OperatingHour;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
        ]);

        $user = auth()->user();

        if ($user->name != trim($request->name)) {
            $text = ucwords($user->name) . ' updated his profile name from ' . $user->name . " to " . $request->name . ", datetime :   " . now();
        } else {
            $text = ucwords($user->name) . ' updated his profile, datetime: ' . now();
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = auth()->user()->id . '_' . time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/users/' . $filename));
            $path = '/uploads/users/' . $filename;
        } else {
            $path = $user->image;
        }

        $user->update([
            'name' => trim($request->name),
            'email' => trim($request->email),
            'phone' => $request->phone,
            'image' => $path,
        ]);

        Log::create([
            'text' => $text,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function save_password(Request $request)
    {
        $request->validate([
            'new_password' => 'required|max:255|confirmed',
        ]);

        $user = auth()->user();

        $user->update([
            'password' => Hash::make(
                $request->new_password
            )
        ]);

        Log::create([
            'text' => ucwords($user->name) . ' changed his password, datetime: ' . now(),
        ]);

        return redirect()->back()->with('success', 'Password Changed Successfully...');
    }

    public function deactivate()
    {
        $user = auth()->user();

        Log::create([
            'text' => ucwords($user->name) . ' deactivated his account, datetime: ' . now(),
        ]);

        $user->subscription->delete();

        return redirect()->route('custom_logout');
    }

    public function business()
    {
        $taxes = Tax::select('id', 'name')->get();
        $operating_hours = OperatingHour::all();
        $days = Helper::get_days();
        $hours = Helper::get_hours();

        $data = compact('taxes', 'operating_hours', 'days', 'hours');
        return view('profile.business', $data);
    }

    public function business_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'google_maps_link' => 'nullable|max:255',
            'website' => 'nullable|max:255'
        ]);

        $business = auth()->user()->business;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = auth()->user()->id . '_' . time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/businesses/' . $filename));
            $path = '/uploads/businesses/' . $filename;
        } else {
            $path = $business->logo;
        }

        $business->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'google_maps_link' => $request->google_maps_link,
            'website' => $request->website,
            'logo' => $path,
            'tax_id' => $request->tax_id,
        ]);

        Log::create([
            'text' => auth()->user()->name . ' updated Business settings, datetime: ' . now(),
        ]);

        return redirect()->back()->with('success', 'Business updated successfully!');
    }

    public function business_operating_hours_update(Request $request)
    {
        $request->validate([
            'day' => 'required|array',
            'open' => 'required|array',
            'opening_hour' => 'nullable|array',
            'closing_hour' => 'nullable|array',
        ]);

        $business = auth()->user()->business;

        foreach ($request->day as $index => $day) {
            $business->operating_hours()->updateOrCreate(
                ['day' => $day],
                [
                    'open' => $request->open[$index] == 'true' ? true : false,
                    'opening_hour' => $request->open[$index] == 'true' ? $request->opening_hour[$index] : null,
                    'closing_hour' => $request->open[$index] == 'true' ? $request->closing_hour[$index] : null,
                ]
            );
        }

        return back()->with('success', 'Business hours updated successfully!');
    }
}
