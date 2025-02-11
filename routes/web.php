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
Route::get('/{label}{naan}/{baseNameAndSuffixes}', function (Request $request, string $label, string $naan, string $baseNameAndSuffixes) {
    return Resolver::resolve($request, $naan, $baseNameAndSuffixes);
})->where([
    'label' => '[Aa][Rr][Kk]:\/?',
    'baseNameAndSuffixes' => '.*'
])->middleware(Language::class);

/** Search ARK via URI */
Route::get('/search/uri/{uri}', function (string $uri) {
    $result = Ark::where('uri', $uri)->pluck('ark');
    return view('search.base', ['results' => $result, 'uri' => $uri]);
})->where('uri', '.*');


Route::get('/test', function () {
    /*
    dump(ArkManagement::splitIntoComponents('https://exampleaark:/99999/a1bark2c3d4e5f6g??&aa=bb#skip'));
    dump(ArkManagement::splitIntoComponents('ark:/99999/a1bark2c3d4e5f6g??&aa=bb#skip'));
    dump(ArkManagement::splitIntoComponents('ark:/99999/a1bark2c3d/4e5f6g?info#skip'));
    dump(ArkManagement::splitIntoComponents('ark:/99999/a1bark2c3d/4e5f6g?info'));
    dump(ArkManagement::splitIntoComponents('ark:/99999/a1bark2c3d'));
    */
    
    dump(ArkManagement::normalize('https://example.org/ark:12345/x6np1wh8k/c3/s5.v7.xsl'));
    dump(ArkManagement::normalize('ark:/99999/a1bark2c3d/4e5f6g?'));
    dump(ArkManagement::normalize('ark:/99999/a1bark2c3d/4e5f6g?info'));
    dump(ArkManagement::normalize('ark:/99999/a1bark2c3d/4e5f6g?INFO&query=true'));
    dump(ArkManagement::normalize('ark:/99999/a1bark2c3d/4e5f6g'));
    dump(ArkManagement::normalize('hgsdjfhjkdsfark:/99999/a1bark2c3d/4e5f6g?info&??'));

});
