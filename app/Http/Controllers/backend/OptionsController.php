<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryOption;
use App\Models\OptionValueLang;
use App\Models\CategoryOptionLang;
use App\Models\CategoryOptionValue;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;

class OptionsController extends Controller {

    function __construct() {
        view()->share('languages', Languages::all());
    }

    function index(Request $request, Category $category) {
    $data = ['options' => CategoryOption::all(), 'category' => $category];
        return view('backend.categories.options.index', $data);
    }

    function create(Request $request, Category $category) {
        $option = new CategoryOption;
        if ($request->isMethod('POST')) {
            return $this->store($request, $category, $option);
        }
        $data = ['option' => $option, 'category' => $category];
        return view('backend.categories.options.create', $data);
    }

    function edit(Request $request, Category $category, CategoryOption $option) {
        if ($request->isMethod('POST'))
            return $this->store($request, $category, $option);
        $data = ['option' => $option, 'category' => $category];
        return view('backend.categories.options.edit', $data);
    }

    function delete(CategoryOption $option) {
        $option->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف بنجاح']);
    }

    function store(Request $request, Category $category, CategoryOption $option) {
        //dd($request->all());
        \DB::beginTransaction();
        try {
            $option->fill($request->option);
            $option->category_id = $category->id;
            $option->save();

            $langs = Languages::all();
            foreach ($langs as $lang) {
                foreach ($request->lang[$lang->id] as $row) {
                    $option->langs()->save(new CategoryOptionLang(['name' => $row, 'lang_id' => $lang->id]));
                }
            }

            //  value[id][]
            //  value[lang_id][name][]
            if (in_array($option->type, [1, 3,2, 5]) && $request->value) {
                foreach ($request->value['id'] as $key => $id) {
                    if ($id == '') {
                        $option_value = new CategoryOptionValue();
                        $option_value->option_id = $option->id;
                        if (array_key_exists('code', $request->value))
                            $option_value->code = $request->value['code'][$key];
                        $option_value->save();
                    }
                    else {
                        $option_value = CategoryOptionValue::find($id);
                        $option_value->option_id = $option->id;
                        if (array_key_exists('code', $request->value))
                            $option_value->code = $request->value['code'][$key];
                        $option_value->save();
                    }
                    $option_value->langs()->delete();
                    foreach ($langs as $lang) {
                        $option_value->langs()->save(
                                new OptionValueLang([
                            'lang_id' => $lang->id,
                            'value' => $request->value[$lang->id]['name'][$key]
                                ])
                        );
                    }
                }
            } else {
                $option->values()->delete();
            }

            \DB::commit();
            return redirect()->back()->with('success', 'تم الحفظ بنجاح');
        } catch (\Exception $ex) {
            \DB::rollback();
            //dd($option_value->id);
            throw $ex;
        }
    }

}
