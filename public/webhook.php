<?php

// Path to your git repository
$repo_path = '/home/ajakbestiebengku/public_html/ajak-bestie-laravel8';
// Secret token from GitHub webhook settings
$secret = 'azvadentech';
// Path to Composer
$composer_path = '/opt/cpanel/composer/bin/composer';
// Path to PHP 8.2
$php_path = '/opt/alt/php74/usr/bin/php'; // Replace with actual path to PHP 7.4

// Get payload from GitHub
$payload = file_get_contents('php://input');
// Get signature header from GitHub
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

// Prepare the response array
$response = [
    'git_pull' => [],
    'composer_messages' => [],
    'artisan_migrate' => []
];

if ($signature) {
    list($algo, $hash) = explode('=', $signature, 2);

    // Check if the signature is valid
    if (hash_equals($hash, hash_hmac($algo, $payload, $secret))) {

        // Change to the repository directory
        chdir($repo_path);

        // Pull the latest changes
        exec('git pull 2>&1', $response['git_pull']);

        // Run Composer install and capture output
        $composer_output = shell_exec("$composer_path install --no-dev --prefer-dist 2>&1");

        // Split output into lines
        $composer_output_lines = explode("\n", $composer_output);

        // Iterate through each line of output
        foreach ($composer_output_lines as $line) {
            // If line contains Composer message, add it to the response
            if (strpos($line, 'Installing dependencies') !== false || strpos($line, 'Generating optimized autoload files') !== false) {
                $response['composer_messages'][] = $line;
            }
        }

        // Run Artisan migrate using PHP 8.2
        exec("$php_path artisan migrate --force 2>&1", $response['artisan_migrate']);

        // Log output for debugging
        $log = '';
        foreach ($response as $command => $output) {
            $log .= strtoupper($command) . ":\n" . implode("\n", $output) . "\n\n";
        }
        file_put_contents('deploy.log', $log, FILE_APPEND);

        // Send a JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Invalid signature
        http_response_code(403);
        echo json_encode(['error' => 'Invalid signature']);
    }
} else {
    // No signature
    http_response_code(400);
    echo json_encode(['error' => 'No signature']);
}
