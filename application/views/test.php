
<?php

// var placeId = '4562230827596951934'; // Replace with your actual place ID
// var apiKey = 'AIzaSyDmwicAbU5d2qDpDKRUWyeS9DdJCHWFjDk'; // Replace with your actual API key

// Place ID of the Google Business Listing
$placeId = '0xaaed8d61680a83ae'; // Replace with your actual place ID

// API key for Google Places API
$apiKey = 'AIzaSyA0b_QP0WemgogBK6RaiqSqAffXSclridw'; // Replace with your actual API key

// Construct the API URL
$apiUrl = 'https://maps.googleapis.com/maps/api/place/details/json?place_id=' . $placeId .
    '&fields=name,rating,reviews&key=' . $apiKey;

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Execute the cURL request and get the response
$response = curl_exec($ch);

// Check for any cURL errors
if (curl_errno($ch)) {
    echo 'Error retrieving Google Business Listing reviews: ' . curl_error($ch);
    exit;
}

// Close cURL
curl_close($ch);

// Parse the JSON response
$data = json_decode($response, true);

print_r($response);
// Extract the reviews from the API response
$reviews = $data['result']['reviews'];

// Iterate through the reviews and display them as needed
foreach ($reviews as $review) {
    $authorName = $review['author_name'];
    $rating = $review['rating'];
    $reviewText = $review['text'];
    // Display the review details as needed
    echo 'Author Name: ' . $authorName . '<br>';
    echo 'Rating: ' . $rating . '<br>';
    echo 'Review Text: ' . $reviewText . '<br><br>';
}

?>
