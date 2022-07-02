<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use DB;

class UsersController extends Controller
{

    public function profile()
    {
        return view('users.profile');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function update(Request $request)
    {
        $auth = Auth::user();


        $user_mail = Auth::user()->mail;
        $validator = Validator::make($request->all(), [
            'username' => ['string', 'min:4', 'max:12',],
            'mail' => ['string', 'email', 'min:4', 'max:12', Rule::unique('users', 'mail')->ignore($user_mail, 'mail')],
            'bio' => ['string', 'max:200'],
            'icon' => ['string', 'alpha_num', 'mimes:jpeg,bmp,png,gif,svg'],

        ]);

        $data = $request->input();       //フォームの内容を文字だけ取り出す

        // ddd($request->all());undifiedとか、項目渡せていなそうなエラーだったら、これ使うとよい。


        //  [
        //     'username.required' => '名前を入力してください.',
        //     'username.min' => '名前は4文字以上で入力してください。',
        //     'username.max' => '名前は12文字以下で入力してください。',
        //     'mail.required' => 'メールアドレスを入力してください。',
        //     'mail.min' => 'メールアドレスは4文字以上で入力してください。',
        //     'mail.max' => 'メールアドレスは30文字以下で入力してください。',
        //     'mail.email' => 'メールアドレスを入力してください。',
        //     'mail.required' => 'このメールアドレスは既に登録されています。',
        //     'newPassword.required' => 'パスワードを入力してください。',
        //     'newPassword.alpha_num' => 'アルファベットまたは数字で入力してください。',
        //     'newPassword.min' => 'パスワードは4文字以上で入力してください。',
        //     'newPassword.max' => 'パスワードは12文字以上で入力してください。',
        // ])->validate();

        if ($data['newPassword']) { //パスワードに記載がある場合に

            if (request('icon')) { //アイコンに画像がある場合の処理
                $images = $request->file('icon')
                    ->getClientOriginalName(); //アップロードされたファイルの名前を取得する。getとかfirstとかじゃ取得できないのでこれを使う。
                $request->file('icon')->storeAs('images/', $images, 'icon_up');
            } else { //画像にアイコンがない場合の処理
                $images = DB::table('users')
                    ->where('id', Auth::id())
                    ->value('images'); //usersテーブルのimagesカラムを持ってくる
            }

            \DB::table('users') //パスワードに記載がある場合の処理
                ->where('id', Auth::id())
                ->update([
                    'username' => $data['userName'],
                    'mail' =>  $data['mail'],
                    'password' => bcrypt($data['newPassword']),
                    'bio' => $data['bio'],
                    'images' => $images,
                    'updated_at' => now(),
                ]);

            return redirect('/top');
        } else {
            //パスワードに記載がない場合の処理
            if (request('icon')) { //アイコンに画像がある場合の処理
                $images = $request->file('icon')
                    ->getClientOriginalName();
                $request->file('icon')->storeAs('images/', $images, 'icon_up');
            } else { //画像にアイコンがない場合の処理
                $images = DB::table('users')
                    ->where('id', Auth::id())
                    ->value('images');
            }

            \DB::table('users') //パスワードに記載がない場合の処理
                ->where('id', Auth::id())
                ->update([
                    'username' => $data['userName'],
                    'mail' =>  $data['mail'],
                    'password' => $auth->password,
                    'bio' => $data['bio'],
                    'images' => $images,
                    'updated_at' => now(),
                ]);
            return redirect('/top');
        }
    }

    public function search()
    {
        return view('users.search');
    }
}
