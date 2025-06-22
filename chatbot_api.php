<?php
require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$input = strip_tags($data["prompt"] ?? "");

if (!$input) {
    echo json_encode(["error" => "Empty prompt"]);
    exit;
}

$apiKey = ''; // Replace
$model = 'models/gemini-2.0-flash';

$client = new Client([
    'base_uri' => 'https://generativelanguage.googleapis.com/v1beta/',
    'headers' => ['Content-Type' => 'application/json']
]);

$systemPrompt = <<<EOT
You are an AI assistant working for Eco Clothes, a sustainable clothing brand. Help users with:
- Order tracking
- Return/refund policies
- Fabric details
- Sizing
- Shipping

If unsure, tell users to contact support@ecoclothes.com.
EOT;

$fullPrompt = "$systemPrompt\n\nUser: $input";

$payload = [
    "contents" => [
        [
            "parts" => [
                ["text" => $fullPrompt]
            ]
        ]
    ]
];

try {
    $response = $client->post("$model:generateContent?key=$apiKey", [
        'json' => $payload
    ]);
    $data = json_decode($response->getBody(), true);
    $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? "No reply from AI.";
    echo json_encode(["reply" => $reply]);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
