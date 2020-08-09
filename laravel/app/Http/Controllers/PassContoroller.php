<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Auth;
  use Hash;

  class PassContoroller extends Controllers
  {
    ...

    public function showChangePasswordForm(){
      return view('auth.changepassword');
    }
    
  }
