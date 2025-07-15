<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settingsList = Setting::all();
        $settings = [];
        
        foreach ($settingsList as $setting) {
            $settings[$setting->key] = $setting;
        }
        
        // Создаем настройки по умолчанию, если их нет
        $defaultSettings = [
            'phone' => '020 3345 3310',
            'email' => 'enquiries@energy-park.co.uk',
            'linkedin' => 'https://www.linkedin.com/company/energypark',
            'instagram' => 'https://www.instagram.com/energy.park/',
            'footer_description' => null,
            'site_title' => null,
            'site_description' => null
        ];
        
        foreach ($defaultSettings as $key => $defaultValue) {
            if (!isset($settings[$key])) {
                $setting = new Setting();
                $setting->key = $key;
                $setting->value = $defaultValue;
                $settings[$key] = $setting;
            }
        }
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);
        $locales = config('app.available_locales', ['en', 'lv']);
        
        foreach ($settings as $key => $values) {
            $setting = Setting::firstOrCreate(['key' => $key]);
            
            // Если значение не требует перевода
            if (in_array($key, ['phone', 'email', 'linkedin', 'instagram'])) {
                $setting->value = $values;
                $setting->save();
            } else {
                // Сохраняем переводы
                foreach ($locales as $locale) {
                    if (isset($values[$locale])) {
                        $setting->translateOrNew($locale)->value = $values[$locale];
                    }
                }
                $setting->save();
            }
        }
        
        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }
}