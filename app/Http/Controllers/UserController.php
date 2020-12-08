<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return User::orderBy("lastname")->get();
        return User::orderBy("id")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "firstname" => ["required", "string"], // TODO reg exp ?
            "lastname" => ["required", "string"],
            "email" => ["required", "string"], // TODO mail unique ?
            // 'phone' => ['required', 'string'],
            "phone" => ["required", "regex:/^[0-9]{10}/"], // alt regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/ complex french phone
            "password" => ["required", "string", "min:6", "confirmed"],
            "password_confirmation" => ["required"],
        ]);

        if (
            User::create([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "phone" => $request->phone,
                "password" => Hash::make($request->password),
            ])
        ) {
            return response()->json(
                [
                    "success" => "Nouvel utilisateur créé avec succès",
                ],
                200
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "firstname" => ["required", "string"], // TODO reg exp ?
            "lastname" => ["required", "string"],
            // 'email' => ['required', 'string'], // TODO email update by user
            "phone" => ["required", "regex:/^[0-9]{10}/"],
            // 'phone' => ['required', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/'],  // alt regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/ complex french phone
            // 'password' => ['string', 'min:6'], // TODO password update by user
            // 'password_confirmation' => [],
        ]);

        if (
            $user->update([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                // 'email' => $request->email,
                "phone" => $request->phone,
                // 'password' => Hash::make($request->password),
            ])
        ) {
            return response()->json(
                [
                    "success" => "Utilisateur modifié avec succès",
                ],
                200
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // deletes registrations of the deleted user in the registrations table => TODO voir si cascade + pertinente
        // Registration::where("user_id", $user->user_id)->delete();

        // Delete user in DB
        $user->delete();
        return response()->json(
            [
                "success" => "Utilisateur supprimé avec succès",
            ],
            200
        );
        // return redirect()->route(ROUTE.TO.USERS.INDEX)->with('success', "XXX has been deleted");    // TODO
    }
}
