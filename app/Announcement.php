<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = [
        'title',
        'body',
        'subscript'
    ];

    public static function getPick()
    {
        return static::orderByRaw('RAND()')->limit(2)->get();
    }
}
