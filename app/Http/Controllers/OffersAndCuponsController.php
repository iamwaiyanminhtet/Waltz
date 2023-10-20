<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OffersAndCupons;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OffersAndCuponsController extends Controller
{
    // create page
    public function createPage () {
        return view('admin.offersAndCoupon.createPage');
    }


    // create
    public function create(Request $request) {
        $this->validateOffers($request);
        $data = $this->convertOffersDataToArray($request);

        if($request->file('offersImage')) {
            if(!(url()->previous() === route('admin#offers#createPage'))) {
                if($request->offersImage !== null) {
                    $oldImageName = OffersAndCupons::where('id',$request->id)->first();
                    $oldImageName = $oldImageName->image;
                    Storage::delete('public/admin/offers/'.$oldImageName);
                }
            }

            $imageName = uniqid().$request->file('offersImage')->getClientOriginalName();
            $request->file('offersImage')->storeAs('public/admin/offers',$imageName);
            $data['image'] = $imageName;
        }

        if(url()->previous() === route('admin#offers#createPage')) {
            OffersAndCupons::create($data);
            return redirect()->route('admin#offers#list')->with(['createdOffers' => 'New Offer has been created']);
        }
        OffersAndCupons::where('id',$request->id)->update($data);
        return redirect()->route('admin#offers#list')->with(['updatedOffers' => 'Offer has been updated']);
    }

    // direct list page
    public function list () {
        $offers = OffersAndCupons::when(request('searchOffers'),function ($query){
            $query->where('label_name', 'like', '%' . request('searchOffers') . '%');
        })
        ->orderBy('created_at','desc')->paginate(5);
        $offers->append(request()->all());
        return view('admin.offersAndCoupon.offersList',compact('offers'));
    }

    // update
    public function update ($id) {
        $offer = OffersAndCupons::where('id',$id)->get()->first();
        return view('admin.offersAndCoupon.updateOffers',compact('offer'));
    }

    // delete
    public function delete($id) {
        $oldImageName = OffersAndCupons::where('id',$id)->first();
        if($oldImageName->image !== null) {
            $oldImageName = $oldImageName->image;
            Storage::delete('public/admin/offers/'.$oldImageName);
        }
        OffersAndCupons::where('id',$id)->delete();

        return redirect()->route('admin#offers#list')->with(['deletedOffers' => 'Offer has been deleted']);
    }

    // validate offers
    private function validateOffers($request) {
        Validator::make($request->all(),[
            'labelName' => 'required',
            'offersImage' => 'image|file|max:800|required_if:labelName,null',
            'description' => 'required',
        ])->validate();
    }

    // convert array data
    private function convertOffersDataToArray ($request) {
        $data = [
         'label_name' => $request->labelName,
         'description' => $request->description,
        ];
        if($request->couponCode !== null) {
            $data ['coupon_code'] = $request->couponCode;
        }

        return $data;
    }
}
