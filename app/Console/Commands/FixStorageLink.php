<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixStorageLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:fix-link {--force : Force recreation of storage link}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix storage symbolic link issues for Windows and Unix systems';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $publicPath = public_path('storage');
        $storagePath = storage_path('app/public');
        
        $this->info('Starting storage link fix...');
        $this->info('Public path: ' . $publicPath);
        $this->info('Storage path: ' . $storagePath);
        
        // Ensure storage/app/public exists
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
            $this->info('Created storage/app/public directory');
        }
        
        // Remove existing storage folder/link if force option is used
        if ($this->option('force') && File::exists($publicPath)) {
            if (File::isDirectory($publicPath) && !File::isLink($publicPath)) {
                File::deleteDirectory($publicPath);
                $this->warn('Removed existing storage directory');
            } elseif (File::isLink($publicPath)) {
                File::delete($publicPath);
                $this->warn('Removed existing storage symlink');
            }
        }
        
        // Check if link already exists and works
        if (File::exists($publicPath) && !$this->option('force')) {
            $this->info('Storage link already exists. Use --force to recreate.');
            return 0;
        }
        
        // Try to create symbolic link
        try {
            if (PHP_OS_FAMILY === 'Windows') {
                // Windows-specific approach
                $this->createWindowsLink($publicPath, $storagePath);
            } else {
                // Unix/Linux/Mac approach
                symlink($storagePath, $publicPath);
                $this->info('Storage link created successfully!');
            }
        } catch (\Exception $e) {
            $this->error('Failed to create symbolic link: ' . $e->getMessage());
            $this->warn('Falling back to copy method...');
            $this->copyStorage($publicPath, $storagePath);
        }
        
        return 0;
    }
    
    /**
     * Create symbolic link on Windows
     */
    private function createWindowsLink($publicPath, $storagePath)
    {
        // Convert paths to Windows format
        $publicPath = str_replace('/', '\\', $publicPath);
        $storagePath = str_replace('/', '\\', $storagePath);
        
        // Try to create directory junction (doesn't require admin rights)
        $command = 'mklink /J "' . $publicPath . '" "' . $storagePath . '"';
        
        $output = [];
        $returnCode = null;
        exec($command . ' 2>&1', $output, $returnCode);
        
        if ($returnCode === 0) {
            $this->info('Windows junction created successfully!');
        } else {
            // Try symbolic link (requires admin rights)
            $command = 'mklink /D "' . $publicPath . '" "' . $storagePath . '"';
            exec($command . ' 2>&1', $output, $returnCode);
            
            if ($returnCode === 0) {
                $this->info('Windows symbolic link created successfully!');
            } else {
                throw new \Exception('Failed to create Windows link. Output: ' . implode("\n", $output));
            }
        }
    }
    
    /**
     * Copy storage files as fallback
     */
    private function copyStorage($publicPath, $storagePath)
    {
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 0755, true);
        }
        
        // Copy all files from storage to public
        $files = File::allFiles($storagePath);
        
        foreach ($files as $file) {
            $relativePath = str_replace($storagePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $destinationPath = $publicPath . DIRECTORY_SEPARATOR . $relativePath;
            
            // Create directory if it doesn't exist
            $destinationDir = dirname($destinationPath);
            if (!File::exists($destinationDir)) {
                File::makeDirectory($destinationDir, 0755, true);
            }
            
            // Copy file
            File::copy($file->getPathname(), $destinationPath);
        }
        
        // Create .gitignore
        File::put($publicPath . '/.gitignore', "*\n!.gitignore\n");
        
        $this->info('Storage files copied successfully!');
        $this->warn('Note: You will need to run this command again when new files are uploaded.');
    }
}