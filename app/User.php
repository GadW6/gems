<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserDetails;
use Illuminate\Support\Facades\DB, Illuminate\Support\Facades\Session, Illuminate\Support\Facades\Hash;

class User extends Model
{
    static public function saveNew($request)
    {
        $user = new self();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();
        DB::table('user_roles')->insert(['u_id' => $user->id, 'r_id' => 6]);
        DB::table('user_details')->insert(['u_id' => $user->id]);
        Session::put([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'is_admin' => false,
        ]);
        Session::flash('sm', 'You registered successfully');
    }

    static public function verify($email, $password)
    {
        $verify = false;

        $user = DB::table('users as u')
            ->join('user_roles as ur', 'u.id', '=', 'ur.u_id')
            ->select('u.id', 'u.name', 'u.email', 'u.password', 'ur.r_id')
            ->where('u.email', '=', $email)
            ->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                $verify = true;
                Session::put([
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'is_admin' => $user->r_id == 7 ? true : false,
                ]);
                Session::flash('sm', 'Welcome back ' . ucfirst($user->name));
            }
        }

        return $verify;
    }

    static public function getFullUser()
    {
        $user = DB::table('users as u')
            ->join('user_details as ud', 'u.id', '=', 'ud.u_id')
            ->select('u.*', 'ud.*')
            ->where('u.id', '=', Session::get('user_id'))
            ->first();

        return $user;
    }

    static public function saveFullUser($uid, $request)
    {
        $user = self::find($uid);
        $user->name = $request['first-name'];
        $user->email = $request['email'];
        if ($request['file'] && $request['file']->isValid()) {
            $sep = '*_*';
            $imgName = time() . $sep . Session::get('user_id') . $sep . $request['file']->getClientOriginalName();
            $user->image = $imgName;

            $request->file->storeAs('avatars', $imgName, 'public');
        }
        if ($request['password'] && $request['password'] != self::getFullUser()->password) {
            $user->password = bcrypt($request['password']);
        }
        $user->save();

        $ud = UserDetails::where('u_id', '=', $uid)->first();
        if ($request['last-name']) {
            $ud->last_name = $request['last-name'];
        }
        if ($request['address']) {
            $ud->address = $request['address'];
        }
        if ($request['city']) {
            $ud->city = $request['city'];
        }
        if ($request['country']) {
            $ud->country = $request['country'];
        }
        $ud->save();

        Session::put([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'is_admin' => false,
        ]);
        Session::flash('sm', 'Your changes were made successfully');
    }
}
