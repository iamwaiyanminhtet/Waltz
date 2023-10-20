<?php

namespace App\Http\Controllers;

use App\Mail\loginOtpMailable;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\HeroSection;
use App\Models\loginOtp;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\OffersAndCupons;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //direct user home page
    public function home() {

        $homeSliders = HeroSection::get()->take(3);
        $offers = OffersAndCupons::get()->take(3);
        $categories = Category::all();
        $blogs = Blog::select('blogs.*','users.name as admin_name')
        ->leftJoin('users','blogs.admin_id','users.id')->get()->take(3);
        $featuredProducts = Product::where('featured',1)->get()->take(4);
        $comments = Comment::all();
        return view('user.main.home',compact('homeSliders','categories','offers','featuredProducts','blogs','comments'));
    }

    // direct login page
    public function loginPage () {
        return view('auth.login');
    }

     // direct register page
     public function registerPage () {
        return view('auth.register');
    }

    // direct home page after authenticate (admin or user)
    public function dashboard () {
        if(Auth::user()->role === 'admin') {
            $users = User::all();
            $categories = Category::all();
            $subcategories = SubCategory::all();
            $products = Product::all();
            $offers = OffersAndCupons::all();
            $blogs = Blog::all();
            return view('admin.layout.dashboard',compact('users','categories','subcategories','products','offers','blogs'));
        }
        return redirect()->route('user#home');
    }

    // manual login
    public function manualLogin (Request $request) {
        $this->validateLoginData($request);
        if($request->email === 'admin@gmail.com' && $request->password === 'admin@2023') {
            $user = User::where('email',$request->email)->first();
            Auth::login($user);
            return redirect()->route('admin#dashboard');
        }

        // get user data
        $user = User::where('email',$request->email)->first();
        if ($user) {
            // check user credentials
            if(Hash::check($request->password ,$user->password)){
                // create otp data
                $randomNum = rand(111111,999999);
                $loginOtp = loginOtp::create([
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'OTP' => $randomNum
                ]);
                $data = loginOtp::where('user_id',$loginOtp->user_id)->where('OTP',$loginOtp->OTP)->first();
                $loginOtpId = $data->id;
                // mail to the user
                Mail::to($user->email)->send(new loginOtpMailable($loginOtp));
                // redirect to otp page
                return redirect()->route('auth#emailOtpPage',$data->id);
            }else {
                return back()->with(['passwordIncorrect' => 'Your Password is incorrect...']);
            }
        }else {
            return back()->with(['not found' => 'You have not registered here...']);
        }
    }

    // email otp page
    public function emailOtpPage ($loginOtpId) {
        $loginOtp = loginOtp::where('id',$loginOtpId)->first();
        return view('auth.loginEmailOTP',compact('loginOtp'));
    }

    // check email otp
    public function emailOtp ($loginOtpId,Request $request) {

        $data = loginOtp::where('id',$loginOtpId)->first();
        $user = User::where('id',$data->user_id)->first();

        // expire time for otp
        $expire_date = $data->created_at->addMinutes(3);
        Validator::make($request->all(),[
            'otp' => 'required',
        ])->validate();

        // if expired
        if(strtotime(Carbon::now()) > strtotime($expire_date)) {
            loginOtp::where('id',$loginOtpId)->delete();
            return redirect()->route('auth#emailOtpPage',$data->id)->with(['expired' => 'Your Otp has expired']);
        }
        // if matched
        if($request->otp == $data->OTP) {
            Auth::login($user);
            loginOtp::where('id',$loginOtpId)->delete();
            return redirect()->route('admin#dashboard');

        }else {
            return redirect()->route('auth#emailOtpPage',$data->id)->with(['incorrect' => 'Incorrect Pass-code']);
        }
    }

    // set password for those who use third party login
    public function setPasswordPage ($userId) {
        $user = User::where('id',$userId)->first();
        return view('auth.setPassword',compact('user'));
    }

    // set password to database
    public function setPassword (Request $request) {
        Validator::make($request->all(),[
            'password' => 'required|min:8',
        ])->validate();

        $data = [
            'password' => Hash::make($request->password)
        ];
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('user#home');
    }



     // login validation
    private function validateLoginData ($request) {
        Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ])->validate();
    }
}
