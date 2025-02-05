<?php

use App\Ams\Resolver;
use App\Http\Middleware\Language;
use App\Models\Ark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Burgerbibliothek\ArkManagementTools\Ark as ArkManagement;

Route::get('/', function () {
    return view('index');
});

/** Resolve incoming ARKs */
Route::get('/{label}{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {
       return Resolver::resolve($request, $naan, $baseNameAndSuffixes);
    })->where(['label' => '[Aa][Rr][Kk]:\/?', 'baseNameAndSuffixes' => '.*'])->middleware(Language::class);

/** Search ARK via URI */
Route::get('/search/uri/{uri}', function (string $uri) {

    $result = Ark::where('uri', $uri)->pluck('ark');

    return view('search.base', ['results' => $result, 'uri' => $uri]);

})->where('uri', '.*');

Route::get('test', function(){
    dump(ArkManagement::splitIntoComponents('ark:36599/7cwb5s084nw'));
    dump(ArkManagement::splitIntoComponents('36599/7cwb5s084nw'));
});
