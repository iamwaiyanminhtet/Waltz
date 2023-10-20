<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    // user profile
    public function profile () {
        $user = User::where('id',Auth::user()->id)->first();
        $orders = Order::where('user_id',Auth::user()->id)->get()->all();
        return view('user.account.profile',compact('user','orders'));
    }

    // update user details
    public function update(Request $request) {
        $this->validateUserAccountUpdate($request);
        $data = $this->convertUpdateDataToArray($request);
        // profile photo
        if($request->hasFile('image')) {
            // delete old photo
            if(Auth::user()->image !== null) {
                $oldImageName = User::where('id',Auth::user()->id)->first();
                $oldImageName = $oldImageName->image;
                Storage::delete('public/admin/account/'.$oldImageName);
            }
            // set image name
            $imageName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/admin/account',$imageName);
            $data['image'] = $imageName;
        }

        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('customer#account#profile')->with('updateSuccess','Changes has saved...');
    }

     // change password
     public function changePassword(Request $request) {
        $this->validatePasswordChange($request);
        $oldPassword = User::where('id', Auth::user()->id)->first();
        $oldPassword = $oldPassword->password;

        if(Hash::check($request->oldPassword ,$oldPassword)){
            $data = [
                'password' => Hash::make($request->confirmPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changeSuccess'=>'Your password has been changed']);
        }
        return back()->with(['notMatch'=>'Your password is not matched with the old one']);

    }

    // convert input data to array
    private function convertUpdateDataToArray ($request) {
        return [
         'name' => $request->name,
         'email' => $request->email,
         'phone' => $request->phone,
         'address' => $request->address,
         'gender' => $request->gender,
        ];
    }

    // user account validation
    private function validateUserAccountUpdate ($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ])->validate();
    }

    // password change validation
    public function validatePasswordChange ($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword',
        ])->validate();
    }
}
