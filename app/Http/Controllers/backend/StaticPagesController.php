<?php

namespace App\Http\Controllers\backend;

use App\Models\StaticPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPageLang;
use Elsayednofal\BackendLanguages\Models\Languages;

class StaticPagesController extends Controller {

    function index() {
        $data['result'] = StaticPage::all();
        return view('backend.static_pages.index', $data);
    }

    function create(Request $request) {
        $data['languages'] = Languages::all();
        $data['static_page'] = $static_page = new StaticPage();
        if ($request->isMethod('post'))
            $this->store($request, $static_page);
        return view('backend.static_pages.create', $data);
    }

    function update(Request $request, StaticPage $static_page) {
        $data['languages'] = Languages::all();
        $data['static_page'] = $static_page;
        if ($request->isMethod('post'))
            $this->store($request, $static_page);
        return view('backend.static_pages.update', $data);
    }

    function store($request, $object) {
        foreach (Languages::all() as $language) {
            $rules['title_' . $language->symbole] = 'required';
        }
        foreach (Languages::all() as $language) {
            $rules['description_' . $language->symbole] = 'required';
        }
        $rules['slug'] = 'required|'.($object->id)?'|unique:static_pages,slug,'.$object->id:'';
        $request->validate($rules);
        $object->slug=$request->slug;
        $object->save();
        foreach (Languages::all() as $lang) {
            $objectlang = StaticPageLang::where('static_page_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new StaticPageLang ();
            $objectlang->title = $request->get('title_' . $lang->symbole);
            $objectlang->description = $request->get('description_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->static_page_id = $object->id;
            $objectlang->save();
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, StaticPage $static_page) {
        $static_page->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }

}
