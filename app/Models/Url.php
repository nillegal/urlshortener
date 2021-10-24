<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'shortened'];

    public $timestamps = false;

    public static function getUniqueShortUrl()
    {
        $shortened = Str::random(5);

        if (self::where('shortened', $shortened)->count() >  0) {
            return self::getUniqueShortUrl();
        }
        return $shortened;
    }
}
