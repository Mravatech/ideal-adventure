<?php
require_once 'HttpClient.php';
require_once 'RequestService.php';
require_once 'HttpClientFactory.php';

$time_start = microtime(true);

// Clear previous hash files
for ($i = 0; $i < 3; $i++) {
    $hashFile = "/app/hash{$i}.txt";
    if (file_exists($hashFile)) {
        unlink($hashFile);
    }
}

$httpClient = HttpClientFactory::create();
$requestService = new RequestService($httpClient, "Shafii", "http://165.22.124.97");

$responseData = $requestService->start();

if ($responseData) {
    // Save response data to a file to pass to Docker containers
    file_put_contents('/app/response_data.json', json_encode($responseData));
    // Signal completion for script1
    file_put_contents('/app/script1_complete', 'done');
   
    echo "Script 1 completed successfully.\n";
}

$time_end = microtime(true);
$execution_time = $time_end - $time_start;
echo "Script 1 Execution Time: $execution_time seconds\n";
?>
