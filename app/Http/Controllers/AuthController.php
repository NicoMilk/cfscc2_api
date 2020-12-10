<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "fail" => "Email et/ou mot de passe inconnu(s)",
            ]);
        }
        if ($user->role == "admin") {
            return $user->createToken("admin_token")->plainTextToken;
        }
        if ($user->role == "member") {
            return $user->createToken("member_token")->plainTextToken;
        }
        if ($user->role == "guest") {
            return $user->createToken("guest_token")->plainTextToken;
        }
    }

    public function whoami()
    {
        $user = Auth::user(); // TODO check user avec Auth::check
        return $user;
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->tokens()
            ->delete();
        return response()->json([
            "success" => "Vous êtes déconnecté (token supprimé avec succès)",
        ]);

        // TODO return redirect()->route("/home");
    }

    // public function logout()
    // {
    //     if (Auth::check()) {
    //         Auth::user()
    //             ->token()
    //             ->revoke();
    //         return response()->json(
    //             ["success" => "Successfully logged out of application"],
    //             200
    //         );
    //     } else {
    //         return response()->json(
    //             ["error" => "api.something_went_wrong"],
    //             500
    //         );
    //     }
    // }
}
