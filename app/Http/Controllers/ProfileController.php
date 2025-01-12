<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Profile::first();
        $data->profile_picture = Storage::url($data->profile_picture);

        return response()->json([
            'status' => 'success',
            'message' => '',
            'data' =>  $data,
            'code' => 200,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function update(ProfileRequest $request)
    {

        $requestValide = $request->validated();

        $data = Profile::first();

        if ($requestValide['profile_picture']) {
            if (!empty($data->profile_picture) && Storage::disk('public')->exists($data->profile_picture)) {
                Storage::disk('public')->delete($data->profile_picture);
            }
            $path = $requestValide['profile_picture']->store('uploade/images', 'public');
            $data->profile_picture = $path;
        }


        $data->update([
            'name' => $requestValide['name'],
            'email' => $requestValide['email'],
            'age' => $requestValide['age'],
            'phone' => $requestValide['phone'],
            'address' => $requestValide['address'],
            'gender' => $requestValide['gender'],

        ]);

        $data = Profile::first();
        $data->profile_picture = Storage::url($data->profile_picture);

        return response()->json([
            'status' => 'success',
            'message' => '',
            'data' =>  $data,
            'code' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
