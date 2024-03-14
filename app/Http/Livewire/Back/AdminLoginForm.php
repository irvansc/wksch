<?php

namespace App\Http\Livewire\Back;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLoginForm extends Component
{
    public $login_id, $password;
    public $returnUrl;
    public function mount()
    {
        $this->returnUrl = request()->returnUrl;
    }
    public function LoginHandler()
    {
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email') {
            $this->validate(
                [
                    'login_id' => 'required|email|exists:users,email',
                    'password' => 'required|min:5'
                ],
                [
                    'login_id.required' => 'Enter your email address',
                    'login_id.email' => 'Invalid email address',
                    'login_id.exists' => 'This email is not registered ',
                    'password.required' => 'Enter your password',
                ]
            );
        } else {
            $this->validate(
                [
                    'login_id' => 'required|exists:users,username',
                    'password' => 'required|min:5'
                ],
                [
                    'login_id.required' => 'Email or Username Is Required',
                    'login_id.exists' => 'This username is not registered ',
                    'password.required' => 'Enter your password',
                ]
            );
        }

        $creds = array($fieldType => $this->login_id, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where($fieldType, $this->login_id)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('admin.login')->with('fail', 'Your account has been Blocked!');
            } else {
                // return redirect()->route('admin.home');
                if ($this->returnUrl != null) {
                    return redirect()->to($this->returnUrl);
                } else {
                    return redirect()->route('admin.home');
                }

            }
        } else {
            session()->flash('fail', 'Incorrect Email/Username or Password');
        }
    }
    public function render()
    {
        return view('livewire.back.admin-login-form');
    }
}
