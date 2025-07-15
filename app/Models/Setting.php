<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = [
        'key',
        'value',
        'type'
    ];

    public $translatedAttributes = ['value'];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        // Если есть перевод, используем его
        if ($setting->translate()) {
            return $setting->translate()->value;
        }

        // Иначе используем значение по умолчанию
        return $setting->value ?? $default;
    }

    public static function set($key, $value, $locale = null)
    {
        $setting = static::firstOrCreate(['key' => $key]);
        
        if ($locale) {
            $setting->translateOrNew($locale)->value = $value;
            $setting->save();
        } else {
            $setting->value = $value;
            $setting->save();
        }

        return $setting;
    }
}

// app/Models/SettingTranslation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    protected $fillable = ['value'];
}