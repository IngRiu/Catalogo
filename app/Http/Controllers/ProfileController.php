<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Request $request)
    {
        return view('profiles.edit')->with([
            'user'=>$request->user(),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        return DB::transaction(function() use($request){
            // dd($request);
            $user =  $request->user();
            $user->fill($request->validated());
            if($user->isDirty('email'))
            {
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            // dd($user);
            $user->save();

            if($request->hasFile('image'))
            {
                if($user->image != null)
                {
                    \Storage::disk('images')->delete($user->image->path);
                    // Storage::disk('images')->delete($user->image->path);
                    $user->image->delete();
                }
                $user->image()->create([
                    'path'=>$request->image->store('users','images'),
                ]);
            }

            return redirect()
                ->route('profile.edit')
                ->withSuccess('Profile edit');
        },5);
    }
}
