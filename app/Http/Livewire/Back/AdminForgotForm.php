<?php

namespace App\Http\Livewire\Back;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminForgotForm extends Component
{
    public function render()
    {
        return view('livewire.back.admin-forgot-form');
    }

    public $email;
    public function ForgotHandler()
    {
        $this->validate(
            ["email" => "required|email|exists:users,email"],
            [
                "email.required" => "The :attribute is required",
                "email.email" => "Invalid email address",
                "email.exists" => "The :attribute is not registered in database",
            ]
        );
        $token = base64_encode(Str::random(64));
        DB::table("password_reset_tokens")->insert([
            "email" => $this->email,
            "token" => $token,
            "created_at" => Carbon::now(),
        ]);

        $user = User::where('email', $this->email)->first();
        $link = route('admin.reset-form', ['token' => $token, 'email' => $this->email]);
        $body_message = "We are received a request to reset password for <b>Larablog</b> account associated with"
            . $this->email . ". <br> You cant reset password by clicking the button bellow";
        $body_message .= "<br>";
        $body_message .= '<a href="' . $link . '" target="_blank" style="color:#FFF; border-color:#22bc66;border-style:solid;
        border-width:10px 180px; background-color:#22bc66;display:inline-block;text-decoration:none; border-radius:3px;
        border-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none; box-sizing:border-box">Reset Password</a>';
        $body_message .= '<br>';
        $body_message .= 'If did you request for a password reset, please ignore this email';
        $data = array(
            'name' => $user->name,
            'link' => $link,
            'email' => $this->email,
        );


        Mail::send('forgot-email-template', $data, function ($message) use ($user) {
            $message->from('noreplay@gmail.com', 'WkngSchool');
            $message->to($user->email, $user->name)->subject('Reset Password');
        });
        $this->email = null;
        session()->flash('success', 'We have e-mailed your password reset link');
    }
}
