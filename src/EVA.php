<?php

namespace Squarebit\EVA;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 *
 */
class EVA {

  /**
   *
   */
  public function __construct() {
  }

  /**
   *
   */
  public function validateEmail(string $email): bool {
    // Get the api key.
    $apiKey = config('eva.apikey');

    $url = 'https://e-va.io/api/email/validate/' . urlencode($email);
    $options = [
      'headers' => [
        'api-key' => $apiKey,
        'CB-ACCESS-TIMESTAMP' => time(),
        'user-agent' => 'Square-bit email validation',
        'Accept' => 'application/json',
      ],
    ];

    // Call the EVA API.
    try {

      $client = new Client();
      $request = $client->request('GET', $url, $options);
      $code = $request->getStatusCode();
      if ($code == 200) {
        $response = $request->getBody()->getContents();
        // Get the data given. Check the status.
        $data = @json_decode($response);
        if ($data === NULL && json_last_error() !== JSON_ERROR_NONE) {
          return config('eva.allow_when_service_unavailable');
        }

        return config('eva.allow_when_' . strtolower($data->state));
      }
    }
    catch (RequestException $e) {
      return config('eva.allow_when_service_unavailable');
    }

    return config('eva.allow_when_service_unavailable');
  }

}
