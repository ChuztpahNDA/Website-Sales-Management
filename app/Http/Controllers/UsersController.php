<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User_repository;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    private $users;

    public function __construct()
    {
        $this->users = new User_repository();
    }

    public function index()
    {
        return view('home');
    }

    // Xử lý đăng nhập
    public function login()
    {
        return view('login.login');
    }

    public function handleLogin(Request $request)
    {
        // Kiểm tra định dạng dữ liệu form.
        $request->validate(
            [
                "Users_ID"  => "required|email",
                "Users_Password" => "required"
            ],
            [
                "Users_ID.required" => "Email không được để trống!",
                "Users_ID.email" => "email không đúng định dạng!",

                "Users_Password.required" => "Password không được để trống!",

            ]
        );

        // Kiêm tra tài khoản mật khẩu trong DB
        $email = $request->Users_ID;
        $userDetail = $this->users->getUser($email)[0];
        if (!Hash::Check($request->Users_Password, $userDetail->password)) {
            $err = "Mật khẩu hoặc tài khoản không chính xác!";
            return view('login.login', [
                'error' => $err
            ]);
        }
        $this->updateStatus($email, 'off');
        $request->session()->put('email', $email);
        $request->session()->put('nameAccount', $userDetail->fullName);
        return redirect()->route('indexAdmin');
    }

    public function handleLogout()
    {
        $email = session('email');
        $this->updateStatus($email, 'on');
        return redirect()->route('indexLogin');
    }

    public function updateStatus($email, $status)
    {
        if ($status == 'off') {
            $this->users->updateStatusUser($email, 'on');
        } elseif ($status == 'on') {
            $this->users->updateStatusUser($email, 'off');
        }
    }

    //Xử lý đăng ký
    public function register()
    {
        return view('login.register');
    }

    public function insertUser(Request $request)
    {

        if ($request->RegisterCheck == "True") { // Kiểm tra xem Người dùng đã chấp nhận điều khoản hay chưa

            // Kiểm tra điều kiện form
            $request->validate(
                [
                    "RegisterEmail" => "required|unique:useraccounts,email|email",
                    "RegisterBirthday" => "required|date",
                    "RegisterName" => "required",
                    "RegisterPass" => "required|min:7|confirmed",
                    "RegisterPass_confirmation" => "required|min:7"
                ],
                [
                    "RegisterEmail.required" => "Email không được để trống",
                    "RegisterEmail.unique" => "Email đã tồn tại",
                    "RegisterEmail.email" => "Email không đúng định dạng",
                    "RegisterBirthday.required" => "Ngày sinh không được để trống",
                    "RegisterBirthday.date" => "Ngày sinh không đúng định dạng",
                    "RegisterName.required" => "Họ tên không được để trống",
                    "RegisterPass.required" => "Mật khẩu không được để trống",
                    "RegisterPass.min" => "Mật khẩu phải dài hơn min: ký tự",
                    "RegisterPass.confirmed" => "Mật khẩu xác nhận không trùng khớp",
                    "RegisterPass_confirmation.required" => "Mật khẩu không được để trống",
                    "RegisterPass_confirmation.min" => "Mật khẩu phải dài hơn min: ký tự"
                ]
            );

            $fullName = $request->RegisterName;
            $email = $request->RegisterEmail;
            $birthDay = $request->RegisterBirthday;
            $password = Hash::make($request->RegisterPass);
            $status = 'off';

            $this->users->addUser($fullName, $email, $password, $birthDay, $status);
        } else {
            $err = "Vui lòng xác nhận điều khoản trước khi đăng ký!";
            return view('login.register', [
                'error' => $err
            ]);
        }

        return redirect()->route('indexLogin');
    }

    // Cập nhật thông tin tài khoản
    public function getUpdateUser()
    {
        return view('login.forgotPassword');
    }

    public function updateUser(Request $request)
    {
        $request->validate(
            [
                "ForgotEmail" => "required|email|exists:useraccounts,email",
                "ForgotPass" => "required|confirmed|min:7",
                "ForgotPass_confirmation" => "required|min:7"
            ],
            [
                "ForgotEmail.required" => "Email không được để trống",
                "ForgotEmail.email" => "Email Không đúng định dạng",
                "ForgotEmail.exists" => "Email Không tồn tại",
                "ForgotPass.required" => "Mật khẩu không được để trống",
                "ForgotPass.confirmed" => "Mật khẩu xác nhận không khớp",
                "ForgotPass.min" => "Mật khẩu không được ngắn hơn :min ký tự",
                "ForgotPass_confirmation.required" => "Mật khẩu không được để trống",
                "ForgotPass_confirmation.min" => "Mật khẩu không được ngắn hơn :min ký tự",
            ]
        );

        $password = Hash::make($request->ForgotPass);
        $email = $request->ForgotEmail;
        $this->users->editUser($email, $password);
        $messageForgot = 'Thay đổi mật khẩu thành công';
        return view('login.login', ['messageForgot' => $messageForgot]);
    }
}
