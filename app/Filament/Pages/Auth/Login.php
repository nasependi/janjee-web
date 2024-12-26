<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
  public function getHeader()
  {
    return view('filament.custom.login-header');
  }
}
