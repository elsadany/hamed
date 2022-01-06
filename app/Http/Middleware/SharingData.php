<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SharingData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('language'))
            $lang=session('language')->symbole;
        else
            $lang='ar';
        $path=resource_path('lang/'.$lang);
        app()->setlocale($lang);

        $allTranslations = collect(File::allFiles($path))->flatMap(function ($file)use($lang) {
            return [
                ($translation = $file->getBasename('.php')) => trans($translation,array(),null,$lang),
            ];
        });
        $categories= \App\Models\Category::where('parent_id',0)->get();
        $settings=[];
        foreach (\App\Models\Settings::all() as $one){
            $settings[$one->key]=$one->value;
        }
        //dd(1,json_encode($allTranslations));
        //dd($allTranslations->toJson());
        // view()->share('trans',$allTranslations);
        //$data=htmlspecialchars(json_encode($allTranslations), ENT_QUOTES, 'UTF-8');
        //dd($allTranslations);
        view()->share('trans',$allTranslations->toJson());
        view()->share('categories',$categories);
        view()->share('settings',$settings);
        return $next($request);
    }
}
