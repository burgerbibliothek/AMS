<?php

use App\Ams\Resolver;
use App\Ams\Metadata;
use App\Http\Middleware\Language;
use App\Models\Imports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('ARK Resolver Service')->header('Content-Type', 'text/plain');
});

/** Resolve incoming ARKs */
Route::get('/ark:{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {
    return Resolver::resolve($request, $naan, $baseNameAndSuffixes);
})->where('baseNameAndSuffixes', '.*')->middleware(Language::class);

/** Redirect ark:/{naan}/{blade} to ark:{naan}/{blade} */
Route::get('/ark:/{naan}/{blade}', function (string $naan, string $baseNameAndSuffixes) {
    return redirect('/ark:' . $naan . '/' . $baseNameAndSuffixes);
})->where('blade', '.*');

/** Resolve NAAN */
Route::get('/ark:/{naan}', function (string $naan) {
    return 'NAAN';
});

/** Resolve TEST */
Route::get('/test', function () {

    Metadata::encodeMetadata("erc", ["test-who", "test-what", "test-when", "test-where"]);

});