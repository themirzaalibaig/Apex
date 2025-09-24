<?php

namespace App\Livewire\Components\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('livewire.components.admin.logout');
    }
}
