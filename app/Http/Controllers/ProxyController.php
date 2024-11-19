<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProxyController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->getPathInfo();

        $headers = collect($request->headers->all())
            ->map(fn($item) => $item[0])
            ->map(fn($item) => Str::replace('stalker.vrkitty.ru', 'yastalker.com', $item));

        //Log::info(var_export($headers, true));

        $response = Http::retry(0)->timeout(5)->withoutRedirecting()->withOptions([
            'curl' => [
                CURLOPT_RESOLVE => ["yastalker.com:80:5.9.10.49"]
            ]
        ])->send($request->method(), 'http://yastalker.com' . $path, [
            'query'   => $request->query(),
            'body'    => $request->getContent(),
            'headers' => $headers->all()
        ]);

        return response($response->body(), $response->status())
            ->withHeaders($response->headers());
    }
}
