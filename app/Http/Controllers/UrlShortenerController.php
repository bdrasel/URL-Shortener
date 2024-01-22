<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function index()
    {
        $urls = UrlShortener::where('user_id', auth()->id())->latest()->paginate(10);
        return view('urls.index', compact('urls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortUrl = Str::random(6);
        if (UrlShortener::where('short_url', $shortUrl)->exists()) {
            $shortUrl = Str::random(6);
        }

        UrlShortener::create([
            'original_url' => $request->original_url,
            'short_url' => $shortUrl,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('shorten.index')->with('success', 'Short URL generated successfully!');
    }

    public function shortener_url($shortUrl)
    {
        $url = UrlShortener::where('short_url', $shortUrl)->firstOrFail();
        $url->increment('clicks');
        return redirect($url->original_url);
    }

    public function statistics($shortUrl)
    {
        $url = UrlShortener::where('short_url', $shortUrl)->with('user')->firstOrFail();
        return view('urls.statistics', compact('url'));
    }

}
