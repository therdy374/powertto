<?php

// Get the source language and text from the request
$sourceLanguage = $_GET['sourceLanguage'];
$sourceText = $_GET['sourceText'];

// Your Google Translate API key
$apiKey = "YOUR_GOOGLE_TRANSLATE_API_KEY";

// URL for Google Translate API
$url = "https://translation.googleapis.com/language/translate/v2?key=$apiKey";

// Data to be sent to Google Translate API
$data = array(
  'source' => $sourceLanguage,
  'target' => 'en', // Always translating to English for simplicity
  'q' => $sourceText,
);

$options = array(
  'http' => array(
    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
    'method' => 'POST',
    'content' => http_build_query($data),
  ),
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Decode the JSON response
$response = json_decode($result, true);

// Extract translated text from the response
$translatedText = $response['data']['translations'][0]['translatedText'];

echo $translatedText;
