<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\AMS\Ark;
use App\AMS\Resolver;
use App\AMS\Erc;
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
    $anvl = new Erc(['Homer', 'Simpson', 'Springfield', 1990]);
    $anvl->story(['Marge', 'Simpson', ['Springfield', 'Illinois'], 'hkjshf khkjs fhkjhsd kjfhkjs hfdlkjfhsdlkjfhkg kjhgds jhfgjhsd gfjh gdsfjh js hdfkjshkjf hsdkjfh dskjhfkjds hf'], 'about');
    $anvl->story(['Bart', 'Simpson', ['Springfield', 'Illinois'], 'hkjshf khkjs fhkjhsd kjfhkjs hfdlkjfhsdlkjfhkg kjhgds jhfgjhsd gfjh gdsfjh js hdfkjshkjf hsdkjfh dskjhfkjds hf'], 'about');
    dump($anvl);
    echo '<pre>'.$anvl->record().'</pre>';
});

Route::get('/ark:{naan}/{baseNameAndSuffixes}', function (Request $request, string $naan, string $baseNameAndSuffixes) {

    $uri = Resolver::resolve($request, $naan, $baseNameAndSuffixes);
    return redirect()->away($uri);

})->where('baseNameAndSuffixes', '.*')->middleware(Language::class);

Route::get('/ark:/{naan}/{blade}', function (string $naan, string $baseNameAndSuffixes){
    return redirect('/ark:'.$naan.'/'.$baseNameAndSuffixes);
})->where('blade', '.*');

