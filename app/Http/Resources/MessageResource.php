<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Message */
class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'nickname'   => $this->nickname,
            'text'       => $this->text,
            'file'       => $this->file,
            'created_at' => $this->created_at
        ];
    }
}
