<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\AMS\Ark;
use App\AMS\Resolver;
use App\AMS\Metadata;
use App\Http\Middleware\Language;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    $test = Metadata::parseKernelMetadata('erc:
    who:Who
    what:What
    when:When
    where:Where');

    dump($test);
});

Route::get('/ark:{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {

    $uri = Resolver::resolve($request, $naan, $baseNameAndSuffixes);
    return redirect()->away($uri);

})->where('baseNameAndSuffixes', '.*')->middleware(Language::class);

Route::get('/ark:/{naan}/{blade}', function (string $naan, string $baseNameAndSuffixes){
    return redirect('/ark:'.$naan.'/'.$baseNameAndSuffixes);
})->where('blade', '.*');

