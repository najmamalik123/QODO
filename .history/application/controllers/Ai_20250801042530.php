<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ai extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function chat()
	{

// set up API credentials and endpoint
$openai_key = "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";
$openai_endpoint = "https://api.openai.com/v1/engines/davinci-codex/completions";

// set up input prompt
$input = "Can you give me 5 names for a electric bike ?";

// set up request headers and data
$headers = [
    "Content-Type: application/json",
    "Authorization: Bearer $openai_key"
];
$data = [
    "prompt" => $input,
    "max_tokens" => 1200,
    "temperature" => 0.6,
    "n" => 1
    // "stop" => "\n"
];

// send POST request to OpenAI API
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $openai_endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => $headers
]);
$response = curl_exec($curl);
curl_close($curl);

// parse response and output generated text
$result = json_decode($response, true);
// $output = $result["choices"][0]["text"];
print_r( $result);
echo $output;

	}
}