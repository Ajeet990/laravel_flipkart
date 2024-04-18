<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserAddress;
use App\Models\User;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;


class AuthController extends Controller
{
    public function show_login()
    {
        return view('inc/login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('message',"Logged out successfully")->with('color', 'success');
    }
    public function login(Request $request)
    {
        // if (\Auth::attempt($request->only('email', 'password'))) {
        if (\Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // return redirect('flipkartHome');
            $allCategory = category::all();
            $productList = [];

            foreach($allCategory as $category) {
                $data = [];
                $product = product::where('cat_id', $category['id'])->get();
                $data['category'] = $category['category_name'];
                $data['products'] = $product;
                $productList[] = $data;
            }
            // return view('inc/welcome');
            return view('inc/welcome', ['productList' => $productList]);

        }
        return redirect('login')->with('message',"Please try again")->with('color', 'danger');
    }
    public function show_register()
    {
        return view('inc/register');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25',
            'email' => 'required|email|max:50',
            'password' => 'required|min:4|confirmed',
            'zipcode' => 'required|min:6',
            'address' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.submit')
                ->withErrors($validator)
                ->withInput();
        }
        //Save user Profile
        $alreadyExist = User::where('email', $request->email)->first();
        if ($alreadyExist) {
            return redirect('login')->with('message', "Email already registered.")->with('color', 'danger');
        }
        $profileName = time().'.'.$request->profile->extension();  
        $request->profile->move(public_path('images/user_profile_images'), $profileName);

        //Save address
        $addressObj = new UserAddress();
        $addressObj->zip_code = $request->zipcode;
        $addressObj->full_address = $request->address;
        $saveAddress = $addressObj->save();
        if ($saveAddress) {
            //Save user data
            $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $addressId = $addressObj->id;
            $userObj = new User();
            $userObj->name = $request->name;
            $userObj->email = $request->email;
            $userObj->otp = $randomNumber;
            $userObj->password = Hash::make($request->password);
            $userObj->profile = $request->profile;
            $userObj->isSeller = 0;
            $userObj->address = $addressId;
            $userRegistered = $userObj->save();
            if ($userRegistered) {
                $data = ['otp' => $randomNumber, 'name' => $request->name];
                $user['to'] = $request->email;
                //send mail to registered user
                Mail::send('email_templates.new_user_mail', $data, function($message) use ($user) {
                    $message->to($user['to']);
                    $message->subject('My flipkart');
                });
            }
        }
        // return redirect()->route('show_login')->with('message', 'Registration success.Please use your credentials to logIn.')->with('color', 'success');
        return redirect('enter_otp')
            ->with('message', 'Please check your email ('.$request->email.'). And enter the otp')
            ->with('color', 'success')
            ->with('email', $request->email);
    }

    public function show_enter_otp()
    {
        // return redirect('enter_otp')->with('message',"Please try again")->with('color', 'danger');
        return view('enter_otp');
    }

    public function submit_otp(Request $request)
    {
        $otp = trim($request->otp) ?? '';
        $email = trim($request->email) ?? '';
        // dd("otp: ".$otp." email: ".$email);
        if ($otp != '' && $email != '') {
            $user = User::where('otp', $otp)->where('email', $email)->whereNull('email_verified_at');
            if ($user) {
                $user->update(['email_verified_at' => date("Y-m-d")]);
                return redirect('login')->with('message', 'OTP verified. Please login with your credentials.')->with('color', 'success');
            }
        } else {
            return redirect('login')->with('message', 'OTP miss matched.')->with('color', 'danger');
        }
    }
}
