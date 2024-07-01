<?php
require_once 'HttpClient.php';
require_once 'RequestService.php';
require_once 'HttpClientFactory.php';

$time_start = microtime(true);

$httpClient = HttpClientFactory::create();
$requestService = new RequestService($httpClient, "Shafii", "http://165.22.124.97");

$hashes = [];
for ($i = 0; $i < 3; $i++) {
    $hashFile = "/app/hash{$i}.txt";
    if (file_exists($hashFile)) {
        $hashContent = file_get_contents($hashFile);
        if ($hashContent) {
            $hashes[] = $hashContent;
            echo "Loaded hash from {$hashFile}: $hashContent\n";
        } else {
            echo "Hash file {$hashFile} is empty.\n";
        }
    } else {
        echo "Hash file {$hashFile} does not exist.\n";
    }
}

$responseData = json_decode(file_get_contents('/app/response_data.json'), true);
$requestService->sendResults($responseData['id'], $hashes);

// Print completion message
echo "Script 3 completed successfully.\n";

$time_end = microtime(true);
$execution_time = $time_end - $time_start;
echo "Script 3 Execution Time: $execution_time seconds\n";
?>
