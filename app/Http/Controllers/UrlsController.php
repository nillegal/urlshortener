<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlsController extends Controller
{
    public function create()
    {
        return view('welcome');
    }



    public function store(Request $request)
    {
        $this->validate($request, ['url' => 'required|url']);

        $record = $this->getRecordForUrl($request->url);

        return view('result')->with('shortened', $record->shortened);
    }

    

    public function show($shortened)
    {
        $url = Url::where('shortened', $shortened)->firstOrFail();

        return redirect($url->url);
    }



    private function getRecordForUrl($url)
    {
        return Url::firstOrCreate(
            ['url' => $url],
            ['shortened' => Url::getUniqueShortUrl()]
        );
    }
}