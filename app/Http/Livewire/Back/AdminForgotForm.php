<?php

namespace App\Http\Livewire\Back;

use App\Models\Setting;
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
        $data = array(
            'name' => $user->name,
            'link' => $link,
            'email' => $this->email,
        );

        $webs = Setting::all();
        foreach ($webs as $web) {
            $web_email = $web->web_email_noreply;
            $web_name = $web->web_name;
        }

        Mail::send('forgot-email-template', $data, function ($message) use ($web_email, $web_name, $user) {
            $message->from($web_email,$web_name);
            $message->to($user->email, $user->name)->subject('Reset Password');
        });
        $this->email = null;
        session()->flash('success', 'We have e-mailed your password reset link');
    }
}
