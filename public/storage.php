<?php
// public/storage.php

// Получаем путь к файлу
$requestUri = $_SERVER['REQUEST_URI'];
$filePath = str_replace('/storage/', '', parse_url($requestUri, PHP_URL_PATH));

// Полный путь к файлу в storage
$fullPath = __DIR__ . '/../storage/app/public/' . $filePath;

// Проверяем существование файла
if (!file_exists($fullPath)) {
    header('HTTP/1.0 404 Not Found');
    exit('File not found');
}

// Определяем MIME тип
$mimeType = mime_content_type($fullPath);

// Отправляем заголовки
header('Content-Type: ' . $mimeType);
header('Content-Length: ' . filesize($fullPath));
header('Cache-Control: public, max-age=31536000');

// Отправляем файл
readfile($fullPath);