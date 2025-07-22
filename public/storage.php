<?php
/**
 * Storage file handler for servers without symlink support
 */

// Get the requested path
$path = isset($_GET['path']) ? $_GET['path'] : '';
$path = trim($path, '/');

// Security: prevent directory traversal
$path = str_replace(['..', '//'], '', $path);

// Build the full path to the file
$filePath = __DIR__ . '/../storage/app/public/' . $path;

// Check if file exists
if (!file_exists($filePath) || is_dir($filePath)) {
    http_response_code(404);
    exit('File not found');
}

// Get the file info
$mimeType = mime_content_type($filePath);
$fileSize = filesize($filePath);

// Set appropriate headers
header('Content-Type: ' . $mimeType);
header('Content-Length: ' . $fileSize);
header('Cache-Control: public, max-age=31536000');

// Output the file
readfile($filePath);
exit;