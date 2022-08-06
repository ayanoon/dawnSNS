<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:30|unique:users',
            'password' => 'required|string|alpha_num|min:4|max:12|confirmed',
        ], [
            'username.required' => '名前を入力してください。',
            'username.min' => '名前は4文字以上で入力してください。',
            'username.max' => '名前は12文字以下で入力してください。',
            'mail.required' => 'メールアドレスを入力してください。',
            'mail.min' => 'メールアドレスは4文字以上で入力してください。',
            'mail.max' => 'メールアドレスは30文字以下で入力してください。',
            'mail.email' => 'メールアドレスを入力してください。',
            'mail.required' => 'このメールアドレスは既に登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.alpha_num' => 'アルファベットまたは数字で入力してください。',
            'password.min' => 'パスワードは4文字以上で入力してください。',
            'password.max' => 'パスワードは12文字以上で入力してください。',
            'password.confirmed' => '同じパスワードを2回入力してください。',
        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }
    // bcrypt:パスワードをセキュアに保存するのを支援する

    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            // リクエスト(フォームで送られてきた入力値)のうち、入力値を$requestへ
            $this->validator($data);
            $this->create($data);
            return redirect('added')->with('name', $data['username']);
            // URLを移りたいので、redirectを使う。redirectで変数を渡したいときにはwithを使う。
            // redirectの時は、sessionで受け取る。変数：name
            // viewで渡すときには、{{$data=>username}}で受け取ればよい。
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
