<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    public function store(LinkRequest $request): JsonResponse
    {
        $code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3) . rand(100, 999);

        $link = Link::firstOrCreate(
            [
                'url' => $request->validated()['url']
            ],
            [
                'code' => $code,
                'clicks' => 0
            ]
        );

        return response()->json([
            'code' => $link->code,
            'short_url' => url($link->code),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function stats(string $code): JsonResponse
    {
        $link = Link::where('code', $code)->firstOrFail();

        return response()->json([
            'url' => $link->url,
            'code' => $link->code,
            'clicks' => $link->clicks,
            'created_at' => $link->created_at->format('Y-m-d\TH:i:s\Z'),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function redirect(string $code)
    {
        $link = Link::where('code', $code)->firstOrFail();
        $link->increment('clicks');

        return redirect($link->url, 302);
    }
}
