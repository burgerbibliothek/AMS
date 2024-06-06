<?php

use App\AMS\Resolver;
use App\Http\Middleware\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Resolve incoming ARK
Route::get('/ark:{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {
    return Resolver::resolve($request, $naan, $baseNameAndSuffixes);
})->where('baseNameAndSuffixes', '.*')->middleware(Language::class);

// Redirect ark:/{naan}/{blade} to ark:{naan}/{blade}
Route::get('/ark:/{naan}/{blade}', function (string $naan, string $baseNameAndSuffixes) {
    return redirect('/ark:' . $naan . '/' . $baseNameAndSuffixes);
})->where('blade', '.*');
