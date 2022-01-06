<?php

namespace App\Http\Controllers\backend;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CityLang;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class CitiesController extends Controller {

    function index() {
        $data['result'] = City::all();
        return view('backend.cities.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['city'] = $city = new City();
        if ($request->isMethod('post'))
            $this->store($request, $city);
        return view('backend.cities.create', $data);
    }

    function update(Request $request, City $city) {
          $data['languages'] = Languages::all();
        $data['city'] = $city ; 
         if ($request->isMethod('post'))
            $this->store($request, $city);
        return view('backend.cities.update', $data);
    }

    function store($request, $object) {
        foreach (Languages::all() as $language) {
            $rules['name_' . $language->symbole] = 'required';
        }
        
        $request->validate($rules);
        $object->shipping=$request->shipping;
         $object->save();
        foreach (Languages::all() as $lang) {
            $objectlang = CityLang::where('city_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new CityLang ();
            $objectlang->name = $request->get('name_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->city_id=$object->id;
            $objectlang->save();
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, City $city) {
        $city->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
