<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicSettings extends Model
{
    use HasFactory;

    protected $table = 'dynamic_settings';

    protected $fillable = ['key', 'value'];

    public static function get($key)
    {
        $setting = self::where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        }
        return null;
    }

    public static function set($key, $value)
    {
        $setting = self::where('key', $key)->first();
        if ($setting) {
            $setting->value = $value;
            $setting->save();
        } else {
            self::create([
                'key' => $key,
                'value' => $value,
            ]);
        }
    }

    public static function getSettings()
    {
        $settings = self::all();
        $data = [];
        foreach ($settings as $setting) {
            $data[$setting->key] = $setting->value;
        }
        return $data;
    }
}
