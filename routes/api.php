<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::get('/test', function () {
    return response()->json(['message' => 'Test route works!']);
});

Route::post('/user', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    return $user;
});
Route::get('/user/{user}',function(user $user){
    return $user;
});
route::put('/user/{user}',function(Request $request, user $user){
    $validated = $request->validate([
        'name' => 'sometimes|required|string',
        'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
        'password' => 'sometimes|required|string|min:6',
    ]);

    if (isset($validated['name'])) {
        $user->name = $validated['name'];
    }
    if (isset($validated['email'])) {
        $user->email = $validated['email'];
    }
    if (isset($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return $user;
});
Route::delete('/user/{user}', function (user $user) {
    $user->delete();
    return response()->json(['message' => 'User deleted successfully.']);
});