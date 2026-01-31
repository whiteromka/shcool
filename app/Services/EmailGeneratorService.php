<?php

namespace App\Services;

use Illuminate\Support\Str;

class EmailGeneratorService
{
    public function generateRandomEmail(): string
    {
        $random1 = Str::random(4);
        $random2 = Str::random(4);
        return 'generated_email_' . $random1 . '@' . $random2 . '.com';
    }
}
