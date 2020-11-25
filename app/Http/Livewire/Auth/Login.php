<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $credential = '';

    /** @var string */
    public $password = '';


    /** @var bool */
    public $remember = false;

    protected $rules = [
        'credential' => ['required'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();
        if (!$this->attemptAuth()) {
            $this->addError('credential', trans('auth.failed'));

            return;
        }

        return redirect()->intended(route('home'));
    }

    public function attemptAuth()
    {
        return Auth::attempt(['email' => $this->credential, 'password' => $this->password], $this->remember) ||
            Auth::attempt(['phone' => $this->credential, 'password' => $this->password], $this->remember) ||
            Auth::attempt(['username' => $this->credential, 'password' => $this->password], $this->remember);
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
