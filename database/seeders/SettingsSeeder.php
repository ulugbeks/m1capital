<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        // Проверяем, есть ли уже настройки
        if (Setting::count() > 0) {
            return; // Если настройки уже есть, не создаем дубликаты
        }
        
        // Создаем настройки
        $settings = [
            ['key' => 'phone', 'value' => '020 3345 3310', 'type' => 'text'],
            ['key' => 'email', 'value' => 'enquiries@energy-park.co.uk', 'type' => 'text'],
            ['key' => 'linkedin', 'value' => 'https://www.linkedin.com/company/energypark', 'type' => 'text'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com/energy.park/', 'type' => 'text']
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
        
        // Создаем переводимые настройки
        $translatableSettings = [
            'footer_description' => [
                'en' => 'Experts in smart EV charging solutions for residential sites and businesses.',
                'lv' => 'Eksperti viedajos EV uzlādes risinājumos dzīvojamiem objektiem un uzņēmumiem.'
            ],
            'site_title' => [
                'en' => 'Energy Park - EV Charging Solutions',
                'lv' => 'Energy Park - EV uzlādes risinājumi'
            ],
            'site_description' => [
                'en' => 'Energy Park provides tailored EV charging solutions for apartment buildings, hotels, holiday parks and workplaces.',
                'lv' => 'Energy Park nodrošina pielāgotus EV uzlādes risinājumus daudzdzīvokļu mājām, viesnīcām, brīvdienu parkiem un darba vietām.'
            ]
        ];
        
        foreach ($translatableSettings as $key => $translations) {
            $setting = Setting::create([
                'key' => $key,
                'type' => 'textarea'
            ]);
            
            foreach ($translations as $locale => $value) {
                $setting->translateOrNew($locale)->value = $value;
            }
            
            $setting->save();
        }
    }
}