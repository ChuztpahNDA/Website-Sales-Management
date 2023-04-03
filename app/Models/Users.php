<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    public function addUser($fullName, $email, $password, $birthDay, $status)
    {
        DB::table('useraccounts')->insert([
            'fullName' => $fullName,
            'email' => $email,
            'password' => $password,
            'birthDay' => $birthDay,
            'status' => $status
        ]);
    }

    public function editUser($email, $password)
    {
        DB::table('useraccounts')
                ->where('email', '=', $email)
                ->update(['password'=> $password]);
    }

    public function getUser($email)
    {
        return DB::table('useraccounts')
                    ->select('*')
                    ->where('email', '=' , $email)
                    ->get();
    }

    public function updateStatusUser($email, $status)
    {
        DB::table('useraccounts')
                ->where('email', '=', $email)
                ->update(['status'=> $status]);
    }
}
