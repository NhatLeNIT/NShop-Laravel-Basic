<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email);
        if ($user->count()) {
            $password = str_random(10);
            $user->update(["password" => bcrypt($password)]);
            $data = ['name' => $email, 'content' => $password];
            Mail::send('mail.mail-reset', $data, function ($message) use ($email) {
                $message->from('it.quinhat@gmail.com', 'Shop.NhatLe.Net');
                $message->to($email, "Khách Hàng");
                $message->subject("Khôi phục mật khẩu");
            });
            return response()->json(["result" => true], 200);
        } else {
            return response()->json(["result" => false], 200);
        }
    }
}
