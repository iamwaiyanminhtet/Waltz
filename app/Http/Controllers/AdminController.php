<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // profile
    public function profile() {
        $user = User::where('id',Auth::user()->id)->get();
        return view('admin.account.profile',compact('user'));
    }

    // edit
    public function edit() {
        return view('admin.account.edit');
    }

    // update
    public function update($userId,Request $request) {
        $this->validateAdminAccountUpdate($request);
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
        return redirect()->route('admin#account#profile')->with('updateSuccess','Account has been updated');

    }

    // delete
    public function delete($id) {
        User::where('id',$id)->delete();
        return redirect()->route('admin#account#userList')->with(['accountDelete' => 'Account has been deleted']);
    }

    // change password page
    public function changePasswordPage () {
        return view('admin.account.changePassword');
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

    // user list & sort user
    public function userList(Request $request) {
        $userList = User::when(request('searchUser'),function ($query){
            $query->orWhere('name', 'like', '%' . request('searchUser') . '%');
            $query->orWhere('email', 'like', '%' . request('searchUser') . '%');
            $query->orWhere('phone', 'like', '%' . request('searchUser') . '%');
            $query->orWhere('address', 'like', '%' . request('searchUser') . '%');
        })
        ->whereIn('role',['user','admin'])->orderBy('created_at','desc')->paginate(3);
        $userList->appends(request()->all());

        if($request->sortUser === "admin") {
            $userList = User::when(request('searchUser'),function ($query){
                $query->orWhere('name', 'like', '%' . request('searchUser') . '%');
                $query->orWhere('email', 'like', '%' . request('searchUser') . '%');
                $query->orWhere('phone', 'like', '%' . request('searchUser') . '%');
                $query->orWhere('address', 'like', '%' . request('searchUser') . '%');
            })
            ->where('role','admin')->orderBy('created_at','desc')->paginate(3);
            $userList->appends(request()->all());
        }else if($request->sortUser === "user") {
            $userList = User::when(request('searchUser'),function ($query){
                $query->orWhere('name', 'like', '%' . request('searchUser') . '%');
                $query->orWhere('email', 'like', '%' . request('searchUser') . '%');
                $query->orWhere('phone', 'like', '%' . request('searchUser') . '%');
                $query->orWhere('address', 'like', '%' . request('searchUser') . '%');
            })
            ->where('role','user')->orderBy('created_at','desc')->paginate(3);
            $userList->appends(request()->all());
        }
        return view('admin.account.userList',compact('userList'));
    }
    // $categories = Category::when(request('searchKey'), function ($query) {
    //     $query->where('name', 'like', '%' . request('searchKey') . '%');
    // })
    //     ->orderBy('id', 'desc')->paginate(4);
    // $categories->appends(request()->all());

    // profile via list
    public function profileViaList ($id) {
        $user = User::where('id',$id)->get()->first();
        return view('admin.account.profileViaList',compact('user'));
    }

    // change role
    public function changeRole($id) {
        $clickedUser = User::where('id',$id)->get()->first();
        if($clickedUser->role === 'admin'){
            $changeRole = [
                'role' => 'user'
            ];
            User::where('id',$id)->update($changeRole);
        }
        if($clickedUser->role === 'user'){
            $changeRole = [
                'role' => 'admin'
            ];
            User::where('id',$id)->update($changeRole);
        }
        return redirect()->route('admin#account#userList')->with(['changedRole' => 'Account role has been changed']);

    }

    // convert array data
    private function convertUpdateDataToArray ($request) {
       return [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'gender' => $request->gender,
       ];
    }

    // admin account validation
    private function validateAdminAccountUpdate ($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'image|file|max:800',
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
