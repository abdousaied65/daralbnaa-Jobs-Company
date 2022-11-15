<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('employee.auth.passwords.email');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('employees');
    }


    public function showForgetPasswordForm()
    {
        return view('employee.auth.passwords.email');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|exists:employees',
        ]);
        $otp = rand(1000, 9999);
        DB::table('employee_password_resets')
            ->where('phone_number',$request->phone_number)
            ->delete();

        DB::table('employee_password_resets')->insert([
            'phone_number' => $request->phone_number,
            'otp' => $otp,
            'created_at' => Carbon::now()
        ]);

        $response = Http::get('https://www.msegat.com/gw/Credits.php', [
            'userName' => env('SMS_userName'),
            'apiKey' => env('SMS_apiKey'),
            'msgEncoding' => env('SMS_msgEncoding'),
        ]);
        if(App::getLocale() == "ar"){
            $message = "رمز التحقق هو ".$otp;
        }
        else{
            $message = "OTP Code Is ".$otp;
        }
        $credits = round($response->body(),2);
        if ($credits > 0){
            $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
                'userName' => env('SMS_userName'),
                'apiKey' => env('SMS_apiKey'),
                'numbers' => $request->phone_number,
                'userSender' => env('SMS_userSender'),
                'msg' => $message,
                'msgEncoding' => env('SMS_msgEncoding'),
            ]);
        }
        return redirect()->route('employee.reset.password.get',$request->phone_number);
    }
    public function showResetPasswordForm($phone) {
        return view('employee.auth.passwords.reset',compact('phone'));
    }
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|exists:employees',
            'otp' => 'required|exists:employee_password_resets',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('employee_password_resets')
            ->where([
                'phone_number' => $request->phone_number,
                'otp' => $request->otp
            ])
            ->first();
        $employee = Employee::where('phone_number', $request->phone_number)
            ->update([
                'password' => Hash::make($request->password) ,
                'remember_token' => Str::random(60),
            ]);

        DB::table('employee_password_resets')->where(['phone_number'=> $request->phone_number])->delete();
        $employee = Employee::where('phone_number', $request->phone_number)
            ->first();
        $this->guard()->login($employee);
        return redirect('employee/home')->with('status', trans('main.password_changed'));
    }
    protected function guard()
    {
        return Auth::guard('employee-web');
    }

}
