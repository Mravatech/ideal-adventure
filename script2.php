<?php
require_once 'HttpClient.php';
require_once 'RequestService.php';
require_once 'HttpClientFactory.php';

$time_start = microtime(true);

$httpClient = HttpClientFactory::create();
$urlIndex = getenv('URL_INDEX');
$responseData = json_decode(file_get_contents('/app/response_data.json'), true);

$requestService = new RequestService($httpClient, "Shafii", "http://165.22.124.97");
$hash = $requestService->processUrl($responseData, $urlIndex);

if ($hash) {
    // Save the hash to a specific file for this URL index
    file_put_contents("/app/hash{$urlIndex}.txt", $hash);
    file_put_contents("/app/script2_{$urlIndex}_complete", 'done');
} else {
    echo "Failed to generate hash for URL index {$urlIndex}.\n";
}

// Print completion message
echo "Script 2 for URL index {$urlIndex} completed successfully.\n";

$time_end = microtime(true);
$execution_time = $time_end - $time_start;
echo "Script 2 for URL index {$urlIndex} Execution Time: $execution_time seconds\n";
?>
