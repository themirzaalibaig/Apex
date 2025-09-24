<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:6')]
    public $password = '';

    public $remember = false;

    public function login()
    {
        $this->validate();

        // User::create( [
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('admin@123'),
        // ]);
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        session()->regenerate();
        session()->flash('success', 'You have been successfully logged in.');
        return $this->redirect('/admin', navigate: true);
    }

    public function render()
    {
        return view('livewire.login');
    }
}
