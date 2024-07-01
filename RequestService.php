<?php
class RequestService {
    private $httpClient;
    private $name;
    private $baseUrl;

    public function __construct(HttpClient $httpClient, $name, $baseUrl) {
        $this->httpClient = $httpClient;
        $this->name = $name;
        $this->baseUrl = $baseUrl;
    }

    public function start() {
        $data = array("name" => $this->name);
        $response = $this->httpClient->post($this->baseUrl . "/start.php", $data);
        return $response;
    }

    public function processUrl($responseData, $urlIndex) {
        $url = $responseData['links'][$urlIndex];
        $response_code = $this->httpClient->get($url)['response'];
        return hash('sha256', $this->name . $response_code);
    }

    public function sendResults($id, $hashes) {
        $data = array(
            "id" => $id,
            "codes" => $hashes
        );

        $response = $this->httpClient->put($this->baseUrl . "/result.php", $data);
        echo $response . "\n";
    }
}
?>
