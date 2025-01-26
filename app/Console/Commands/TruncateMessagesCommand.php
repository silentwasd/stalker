<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TruncateMessagesCommand extends Command
{
    protected $signature = 'truncate:messages';

    protected $description = 'Truncate messages';

    public function handle(): void
    {
        $count = Message::whereNotNull('file')->count();

        if ($count <= 100)
            return;

        foreach (Message::oldest()->whereNotNull('file')->take($count - 100)->get() as $message) {
            Storage::disk('public')->delete($message->file);

            if (!$message->text)
                $message->delete();
        }
    }
}
