<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return cache()->rememberForever("setting_{$key}", function () use ($key, $default) {
            return Setting::where('key', $key)->value('value') ?? $default;
        });
    }
}

if (!function_exists('storage_url')) {
    function storage_url($path)
    {
        if (empty($path)) {
            return null;
        }
        
        // Убираем storage/ если он есть в начале пути
        $path = preg_replace('/^storage\//', '', $path);
        
        return url('storage/' . ltrim($path, '/'));
    }
}