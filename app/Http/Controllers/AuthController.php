<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Doctors;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    // Get authenticated user
    public function user(Request $request)
    {
        return response()->json($request->user());
    }


    public function register(Request $request)
    {
        // Set default password
        $default_password = "password";
    
        // Create user
        $user = Users::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'password' => Hash::make($default_password),
            'role' => $request->role,
        ]);
    
        // Check if role is 4 (Doctor)
        if ($request->role == 4) {
            // Concatenate firstName and lastName for doctorName
            $doctorName = $request->firstName . ' ' . $request->lastName;
    
            // Create doctor entry
            Doctors::create([
                'doctorName' => $doctorName,
                'department' => 'Opthalmology',
                'title' => 'Dr.',
                'userId' => $user->id,
            ]);
        }
    
        // Return response
        return response()->json([
            'message' => "User successfully created",
        ]);
    }
    
}