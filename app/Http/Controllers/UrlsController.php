<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlsController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store()
    {
        $data = ['url' => request('url')];

        Validator::make($data, [
            'url' => 'required|url'
        ])->validate();


        $url = Url::where('url', request('url'))->first();

        if ($url) {
            return view('result')->with('shortened', $url->shortened);
        }

        $newurl = Url::create([
            'url'       => request('url'),
            'shortened' => Url::getUniqueShortUrl()
        ]);

        if ($newurl) {
            return view('result')->with('shortened', $newurl->shortened);
        }
    }

    public function show($shortened)
    {
        $url = Url::where('shortened', $shortened)->first();

        if (!$url) {
            return redirect('/');
        } else {
            return redirect($url->url);
        }
    }
}
