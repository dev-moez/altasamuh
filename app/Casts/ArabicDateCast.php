<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ArabicDateCast implements CastsAttributes
{
    // Converts the value when accessing the attribute
    public function get($model, string $key, $value, array $attributes)
    {
        // Parse the created_at value using Carbon
        $date = Carbon::parse($value)->locale('ar')->translatedFormat('l j F Y h:i A');

        // Replace English numbers with Arabic Hindi numbers
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $formattedDate = str_replace($englishNumbers, $arabicNumbers, $date);

        return $formattedDate;
    }

    // No changes needed when setting the attribute (from a form or request), so we return the value as it is
    public function set($model, string $key, $value, array $attributes)
    {
        return $value; // You can customize this if you need specific date formatting for storage
    }
}
