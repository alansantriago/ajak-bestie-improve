<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SettingController extends Controller
{
    
    public function maintenanceOn()
    {
        $secretCode = 'azvadenTech';

        Artisan::call("down --secret={$secretCode}");

        return redirect('/');
    }
    public function maintenanceOff()
    {
        Artisan::call('up');

        return redirect('/');
    }
    public function artisanCommand($command)
    {
        Artisan::call($command);

        return redirect('/');
    }

    public function exportDatabase()
    {
        // Konfigurasi database
        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbName = env('DB_DATABASE', 'laravel');
        $dbUser = env('DB_USERNAME', 'root');
        $dbPassword = env('DB_PASSWORD', '');

        // Nama file backup
        $backupFile = storage_path("app/backup-{$dbName}-" . date('Y-m-d_H-i-s') . ".sql");

        try {
            // Jalankan perintah mysqldump
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s',
                escapeshellarg($dbUser),
                escapeshellarg($dbPassword),
                escapeshellarg($dbHost),
                escapeshellarg($dbName),
                escapeshellarg($backupFile)
            );

            exec($command);

            // Cek apakah file berhasil dibuat
            if (!file_exists($backupFile)) {
                return response()->json(['error' => 'Gagal membuat backup database'], 500);
            }

            // Unduh file
            return Response::download($backupFile)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deploy(Request $request)
    {
        // Hardcoded secret key
        $secret = 'azvadenTech';

        // Validasi secret key dari query string
        $requestSecret = $request->query('secret');
        if ($requestSecret !== $secret) {
            return response()->json(['error' => 'Invalid secret key'], 403);
        }

        // Path ke repository
        $repoPath = '/home/ajakbestiebengku/public_html/ajak-bestie-laravel8';
        $composerPath = '/opt/cpanel/composer/bin/composer';
        $phpPath = '/opt/alt/php74/usr/bin/php';

        // Persiapkan response array
        $response = [
            'git_pull' => [],
            'composer_messages' => [],
        ];

        try {
            // Jalankan git pull
            chdir($repoPath);
            exec('git pull 2>&1', $response['git_pull']);

            // Jalankan composer install
            $composerOutput = shell_exec("$composerPath install --no-dev --prefer-dist 2>&1");
            $composerOutputLines = explode("\n", $composerOutput);

            // Ambil output composer yang relevan
            foreach ($composerOutputLines as $line) {
                if (strpos($line, 'Installing dependencies') !== false || strpos($line, 'Generating optimized autoload files') !== false) {
                    $response['composer_messages'][] = $line;
                }
            }

            // Log output untuk debugging
            $log = '';
            foreach ($response as $command => $output) {
                $log .= strtoupper($command) . ":\n" . implode("\n", $output) . "\n\n";
            }
            Log::info($log);

            // Kirim response dalam format JSON
            return response()->json($response, 200);
        } catch (\Exception $e) {
            Log::error('Deployment failed: ' . $e->getMessage());
            return response()->json(['error' => 'Deployment failed', 'message' => $e->getMessage()], 500);
        }
    }
}
