<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value',
    ];

    protected $primaryKey = 'key';
    public $incrementing = false;
    public $timestamps = false;

    public static function getValue($key, $default = '')
    {
        $config = static::find($key);
        return $config ? $config->value : $default;
    }

    public static function setValue($key, $value)
    {
        static::query()->updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
        ]);
    }
}
