<?php

use App\Models\Url;
// use Nette\Utils\Validators;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// affichage de la vue welcome par defaut
Route::get('/', function () {
    return view('welcome');
});

// post de l'url puis verification de l'url dans la base de donnees
Route::post('/', function () {

    $data = ['url' => request('url')];

    Validator::make($data, [
        'url' => 'required|url'
    ])->validate();

    // if($validation->fails()){
    //     dd("failed");
    // } else {
    //     dd ("success");
    // }

    $url = Url::where('url', request('url'))->first();

    if ($url) {
        return view('result')->with('shortened', $url->shortened);
    }

    $newurl = Url::create([
        'url'       => request('url'),
        'shortened' => Url::getUniqueShortUrl()
    ]);

    if($newurl){
        return view('result')->with('shortened', $newurl->shortened);
    }
});


// quand on clique sur l'url raccourci on redirige vers l'url par defaut qui a ete initialement entree
Route::get('/{shortened}', function ($shortened) {
    $url = Url::where('shortened', $shortened)->first();

    if (!$url) {
        return redirect('/');
    } else {
        return redirect($url->url); 
    }
});
