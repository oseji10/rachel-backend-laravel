<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Users;
use App\Models\Doctors;
use Illuminate\Support\Str;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

// use Tymon\JWTAuth\Facades\JWTAuth; // Ensure the facade is imported
use App\Models\RefreshToken;    
use Carbon\Carbon;

class AuthController extends Controller
{
protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    
  public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    // Find user by email or phone number with staff and role relationships
    $user = Users::where('email', $request->email)
                // ->orWhere('phoneNumber', $request->username)
                ->first();

    if (!$user) {
        throw ValidationException::withMessages([
            'username' => ['No account found with this email or phone number.'],
        ]);
    }

    // Attempt JWT authentication
    $credentials = [
        'email' => $user->email,
        'password' => $request->password,
    ];

    if (!$accessToken = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Generate refresh token
    $refreshToken = Str::random(64);
    $user = auth('api')->user()->load(['user_role']); // Reload relationships

    // Store refresh token in database
    RefreshToken::create([
        'user_id' => $user->id,
        'token' => $refreshToken,
        'expires_at' => Carbon::now()->addDays(14),
    ]);

    // Hide sensitive data
    $user->makeHidden(['password']);

    // Return response with cookies
    return response()->json([
        'message' => 'Logged in',
        'firstName' => $user->firstName ?? '',
        'lastName' => $user->lastName ?? '',
        'email' => $user->email ?? '',
        'phoneNumber' => $user->phoneNumber ?? '',
        // 'role' => $user->role ? $user->role->roleName ?? '' : '', // Safe access
        'role' => $user->user_role->roleName ?? '',
        // 'applicationType' => $user->application_type  ? $user->application_type->typeName ?? '' : null, // Safe access
        // 'lga' => $user->staff && $user->staff->lga ? $user->staff->lga_info->lgaName ?? '' : null, // Safe access
        'access_token' => $accessToken,
    ])
        ->cookie('access_token', $accessToken, 30, null, null, true, true, false, 'strict')
        ->cookie('refresh_token', $refreshToken, 14 * 24 * 60, null, null, true, true, false, 'strict');
}

    public function refresh(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');

        if (!$refreshToken) {
            return response()->json(['error' => 'Refresh token missing'], 401);
        }

        // Verify refresh token
        $tokenRecord = RefreshToken::where('token', $refreshToken)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$tokenRecord) {
            return response()->json(['error' => 'Invalid or expired refresh token'], 401);
        }

        // Generate new access token
        $user = Users::find($tokenRecord->user_id);
        // $newAccessToken = JWTAuth::fromUser($user);
        $newAccessToken = $this->jwt->fromUser($user);
        

        // Optionally, issue a new refresh token and invalidate the old one
        $newRefreshToken = Str::random(64);
        $tokenRecord->update([
            'token' => $newRefreshToken,
            'expires_at' => Carbon::now()->addDays(14),
        ]);

        return response()->json(['message' => 'Token refreshed'])
            ->cookie('access_token', $newAccessToken, 15, null, null, true, true, false, 'strict')
            ->cookie('refresh_token', $newRefreshToken, 14 * 24 * 60, null, null, true, true, false, 'strict');
    }
      

  
    public function logout(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');

        if ($refreshToken) {
            RefreshToken::where('token', $refreshToken)->delete();
        }

        return response()->json(['message' => 'Logged out'])
            ->cookie('access_token', '', -1)
            ->cookie('refresh_token', '', -1);
    }

    // Get authenticated user
    public function user(Request $request)
    {
        return response()->json($request->user());
    }


//     public function login(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     $user = Users::where('email', $request->email)->first();

//     if (!$user || !Hash::check($request->password, $user->password)) {
//         throw ValidationException::withMessages([
//             'email' => ['The provided credentials are incorrect.'],
//         ]);
//     }

//     // Create a Sanctum token
//     $token = $user->createToken('auth-token')->plainTextToken;

//     return response()->json([
//         'user' => $user,
//         'token' => $token,
//     ]);
// }

//     // Logout
//     public function logout(Request $request)
//     {
//         $request->user()->tokens()->delete();

//         return response()->json(['message' => 'Logged out successfully']);
//     }

    // Get authenticated user
    // public function user(Request $request)
    // {
    //     return response()->json($request->user());
    // }


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


    public function changePassword(Request $request)
{
    // Validate input
    $request->validate([
        'currentPassword' => 'required',
        'newPassword' => 'required|min:6', // 'confirmed' ensures newPassword_confirmation is also sent
    ]);

    $user = Auth::user();

    // Check if the current password matches
    if (!Hash::check($request->currentPassword, $user->password)) {
        return response()->json(['message' => 'Current password is incorrect.'], 422);
    }

    // // Only update the fields if they are provided
    // if ($request->has('email')) {
    //     $user->email = $request->email;
    // }
    // if ($request->has('phoneNumber')) {
    //     $user->phoneNumber = $request->phoneNumber;
    // }
    // if ($request->has('firstName')) {
    //     $user->firstName = $request->firstName;
    // }
    // if ($request->has('lastName')) {
    //     $user->lastName = $request->lastName;
    // }

    // Update the user's password
    $user->password = Hash::make($request->newPassword);
    $user->save();

    return response()->json(['message' => 'Password changed successfully.']);
}



public function updateProfile(Request $request)
{
    // Find the patient by ID
    $user = Users::where('email', $request->email)->first();

    
    if (!$user) {
        return response()->json([
            'error' => 'User not found',
        ], 404); // HTTP status code 404: Not Found
    }

    
    $data = $request->all();

    
    $user->update($data);

    
    return response()->json([
        'message' => 'User updated successfully',
        'data' => $user,
    ], 200); // HTTP status code 200: OK
}
    
}
