<?php

use App\AMS\Resolver;
use App\AMS\Ncda;
use App\Http\Middleware\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Resolve incoming ARK
Route::get('/ark:{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {

    $uri = Resolver::resolve($request, $naan, $baseNameAndSuffixes);
    return redirect()->away($uri);

})->where('baseNameAndSuffixes', '.*')->middleware(Language::class);

// Redirect ark:/{naan}/{blade} to ark:{naan}/{blade}
Route::get('/ark:/{naan}/{blade}', function (string $naan, string $baseNameAndSuffixes){
    return redirect('/ark:'.$naan.'/'.$baseNameAndSuffixes);
})->where('blade', '.*');