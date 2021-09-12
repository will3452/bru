<?php

namespace App\Observers;

use App\Chapter;

class ChapterObserver
{
    public function creating(Chapter $chapter)
    {
        if ($chapter['mode'] == 'prologue') {
            $chapter['sq'] = '0';
        } else if ($chapter['mode'] == 'epilogue') {
            $chapter['sq'] = '9999';
        }
    }
}
