<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixStorageLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:fix-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix storage symbolic link issues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $publicPath = public_path('storage');
        $storagePath = storage_path('app/public');
        
        // Проверяем, существует ли папка storage в public
        if (file_exists($publicPath)) {
            // Если это не символическая ссылка, а обычная папка
            if (!is_link($publicPath)) {
                $this->warn('Removing existing storage directory...');
                // Удаляем папку рекурсивно
                $this->deleteDirectory($publicPath);
            } else {
                // Если это символическая ссылка, удаляем её
                $this->warn('Removing existing storage symlink...');
                unlink($publicPath);
            }
        }
        
        // Создаем папку app/public если её нет
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
            $this->info('Created storage/app/public directory');
        }
        
        // Пытаемся создать символическую ссылку
        try {
            if (PHP_OS_FAMILY === 'Windows') {
                // Для Windows используем команду mklink
                $command = 'mklink /D "' . $publicPath . '" "' . $storagePath . '"';
                exec($command, $output, $returnCode);
                
                if ($returnCode !== 0) {
                    throw new \Exception('Failed to create symlink on Windows');
                }
            } else {
                // Для Unix-подобных систем
                symlink($storagePath, $publicPath);
            }
            
            $this->info('The storage link has been successfully created.');
        } catch (\Exception $e) {
            // Если не удалось создать символическую ссылку, копируем содержимое
            $this->error('Failed to create symbolic link: ' . $e->getMessage());
            $this->warn('Falling back to directory copy method...');
            
            // Создаем папку storage в public
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            
            // Копируем содержимое
            $this->copyDirectory($storagePath, $publicPath);
            $this->info('Storage directory has been copied to public folder.');
            
            // Создаем файл .gitignore
            file_put_contents($publicPath . '/.gitignore', "*\n!.gitignore\n");
        }
        
        return 0;
    }
    
    /**
     * Рекурсивно удаляет директорию
     */
    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return;
        }
        
        if (!is_dir($dir)) {
            unlink($dir);
            return;
        }
        
        $files = array_diff(scandir($dir), ['.', '..']);
        
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        
        rmdir($dir);
    }
    
    /**
     * Рекурсивно копирует директорию
     */
    private function copyDirectory($source, $destination)
    {
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }
        
        $files = array_diff(scandir($source), ['.', '..']);
        
        foreach ($files as $file) {
            $sourcePath = $source . '/' . $file;
            $destPath = $destination . '/' . $file;
            
            if (is_dir($sourcePath)) {
                $this->copyDirectory($sourcePath, $destPath);
            } else {
                copy($sourcePath, $destPath);
            }
        }
    }
}