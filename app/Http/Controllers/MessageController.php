<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nickname' => 'nullable|string|max:20',
            'text'     => 'nullable|string|max:65535',
            'file'     => 'nullable|image|max:10000'
        ]);

        Message::create([
            ...$data,
            'nickname' => $data['nickname'] ?? 'Гость',
            'file'     => $request->hasFile('file') ? $request->file('file')->store('files', 'public') : null
        ]);
    }
}
