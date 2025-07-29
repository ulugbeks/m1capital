<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class SyncStorageFiles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only sync on admin routes that might upload files
        if ($request->is('admin/*') && $request->isMethod('post')) {
            $this->syncRecentFiles();
        }
        
        return $next($request);
    }
    
    /**
     * Sync recently uploaded files
     */
    private function syncRecentFiles()
    {
        // Skip if using symlinks
        if (env('STORAGE_LINK_TYPE') !== 'copy') {
            return;
        }
        
        $sourcePath = storage_path('app/public');
        $destPath = public_path('storage');
        
        if (!File::exists($sourcePath)) {
            return;
        }
        
        // Get files modified in the last 5 minutes
        $recentTime = time() - 300;
        $files = File::allFiles($sourcePath);
        
        foreach ($files as $file) {
            if ($file->getMTime() > $recentTime) {
                $relativePath = str_replace($sourcePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $relativePath = str_replace('\\', '/', $relativePath);
                
                $destFile = $destPath . '/' . $relativePath;
                $destDir = dirname($destFile);
                
                if (!File::exists($destDir)) {
                    File::makeDirectory($destDir, 0755, true);
                }
                
                File::copy($file->getPathname(), $destFile);
            }
        }
    }
}