<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showChangePasswordForm()
    {
      return view('auth.changepassword');
    }
    //パスワード変更処理
    public function changePassword(Request $request)
    {
      //現在のパスワードが正しいか確認する
      if(!(Hash::check($request->get('current-password'), Auth::user()->password))){
        return redirect()->back()->with('change_password_error', '現在のパスワード違います。');
      }
      //新しいパスワードが現在のパスワードと同じにしないようにする
      if(strcmp($request->get('current-password'),$request->get('new-password')) == 0){
        return redirect()->back()->with('change_password_error', '新しいパスワードは現在のパスワードと違うパスワードにして下さい。');
      }
      //パスワードのバリデーション設定、8文字以上にしないと弾くようにする
      $validated_data = $request->validate([
        'current-password' => 'required',
        'new-password' => 'required|string|min:8|confirmed',
      ]);
      //パスワードの変更
      $user = Auth::user();
      $user->password = bcrypt($request->get('new-password'));
      $user->save();

      return redirect()->back()->with('change_password_success','パスワードを変更しました。');
    }

}
