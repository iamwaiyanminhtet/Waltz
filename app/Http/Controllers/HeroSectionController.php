<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HeroSectionController extends Controller
{
    // create page
    public function createPage () {
        $categories = Category::get();
        return view('admin.homeSlider.createPage',compact('categories'));
    }

    // create
    public function create (Request $request) {
        $this->validateHomeSLiders($request);
        $data = $this->convertHomeSlidersDataToArray($request);

        if($request->file('image')) {
            if(!(url()->previous() === route('admin#homeSliders#createPage'))) {
                if($request->image !== null) {
                    $oldImageName = HeroSection::where('id',$request->id)->first();
                    $oldImageName = $oldImageName->image;
                    Storage::delete('public/admin/homeSliders/'.$oldImageName);
                }
            }

            $imageName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/admin/homeSliders',$imageName);
            $data['image'] = $imageName;
        }

        if(url()->previous() === route('admin#homeSliders#createPage')) {
            HeroSection::create($data);
            return redirect()->route('admin#homeSliders#list')->with(['createdSlider' => 'New Slider has been created']);
        }
        HeroSection::where('id',$request->id)->update($data);
        return redirect()->route('admin#homeSliders#list')->with(['updatedSliders' => 'Slider has been updated']);
    }

     // direct list page
     public function list () {
        $sliders = HeroSection::select('hero_sections.*','categories.name as category_name')->when(request('searchSlider'),function ($query){
            $query->where('title', 'like', '%' . request('searchSlider') . '%');
        })->leftJoin('categories','hero_sections.category_id','categories.id')
        ->orderBy('created_at','desc')->paginate(5);
        $sliders->append(request()->all());
        return view('admin.homeSlider.sliderList',compact('sliders'));
    }

    // update
    public function update ($id) {
        $slider = HeroSection::where('id',$id)->get()->first();
        $categories = Category::get();
        return view('admin.homeSlider.updateSlider',compact('slider','categories'));
    }

    // delete
    public function delete($id) {
        $oldImageName = HeroSection::where('id',$id)->first();
        if($oldImageName->image !== null) {
            $oldImageName = $oldImageName->image;
            Storage::delete('public/admin/homeSliders/'.$oldImageName);
        }
        HeroSection::where('id',$id)->delete();

        return redirect()->route('admin#homeSliders#list')->with(['deletedSlider' => 'Slider has been deleted']);
    }

     // validate slider
     private function validateHomeSLiders($request) {
        Validator::make($request->all(),[
            'title' => 'required',
            'image' => 'image|file|max:800|required_if:categoryName,null',
            'categoryId' => 'required',
        ])->validate();
    }

    // convert array data
    private function convertHomeSlidersDataToArray ($request) {
        return [
         'title' => $request->title,
         'category_id' => $request->categoryId
        ];
    }

}
