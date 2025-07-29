<?php
/**
 * Storage file router - place this in public/storage-files.php
 */

// Get the requested path
$path = $_GET['path'] ?? '';
$path = trim($path, '/');
$path = str_replace('..', '', $path); // Security: prevent directory traversal

// Build the actual file path
$filePath = __DIR__ . '/../storage/app/public/' . $path;

// Check if file exists
if (!file_exists($filePath) || !is_file($filePath)) {
    http_response_code(404);
    echo 'File not found';
    exit;
}

// Get MIME type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $filePath);
finfo_close($finfo);

// Set headers
header('Content-Type: ' . $mimeType);
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: public, max-age=31536000');

// Output the file
readfile($filePath);
exit;