<?php

use App\Ams\Resolver;
use App\Http\Middleware\Language;
use App\Models\Ark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

/** Resolve incoming ARKs */
Route::get('/ark:{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {

    return Resolver::resolve($request, $naan, $baseNameAndSuffixes);

})->where('baseNameAndSuffixes', '.*')->middleware(Language::class);

/** Redirect ark:/{naan}/{baseNameAndSuffixes} to ark:{naan}/{baseNameAndSuffixes} */
Route::get('/ark:/{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {

    $query = array_map(fn($value): string => $value ? $value : '', $request->query());
    return redirect('/ark:' . $naan . '/' . $baseNameAndSuffixes . '?' . http_build_query($query));

})->where('baseNameAndSuffixes', '.*');

/** Search ARK via URI */
Route::get('/search/uri/{uri}', function(string $uri) {
    
    $result = Ark::where('uri', $uri)->pluck('ark');
    return view('search.base', ['results' => $result, 'uri' => $uri]);

})->where('uri', '.*');
