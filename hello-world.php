<?php
session_start();

// Simulating Cognito authentication result
// In a real scenario, you'd get this from Cognito after token exchange
$code = $_GET['code'] ?? null;
if ($code) {
    // Simulate getting email from Cognito
    $_SESSION['user_email'] = "renatogentil87@gmail.com";
}

// Function to get quotes from your API
function getQuotes($email) {
    $apiEndpoint = "https://your-api-gateway-url/stage/quotes?email=" . urlencode($email);
    
    $ch = curl_init($apiEndpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    }
    
    return null;
}

$userEmail = $_SESSION['user_email'] ?? null;
$quotes = [];

if ($userEmail) {
    $quotesData = getQuotes($userEmail);
    if ($quotesData) {
        $quotes = $quotesData['quotes'] ?? [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
            padding-top: 50px;
        }
        .dashboard {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .quote-card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard">
            <h1 class="mb-4">Hello, <?php echo htmlspecialchars($userEmail); ?>!</h1>
            
            <?php if (empty($quotes)): ?>
                <p>No quotes found for your account.</p>
            <?php else: ?>
                <h2>Your Quotes:</h2>
                <?php foreach ($quotes as $quote): ?>
                    <div class="card quote-card">
                        <div class="card-body">
                            <h5 class="card-title">Quote ID: <?php echo htmlspecialchars($quote['quoteId']); ?></h5>
                            <p class="card-text">
                                <strong>Price:</strong> <?php echo htmlspecialchars($quote['quotePrice']); ?><br>
                                <strong>Car:</strong> <?php echo htmlspecialchars($quote['carDetails']['year'] . ' ' . $quote['carDetails']['maker'] . ' ' . $quote['carDetails']['model']); ?><br>
                                <strong>Cover Start:</strong> <?php echo htmlspecialchars($quote['coverStart']); ?><br>
                                <strong>Request Date:</strong> <?php echo htmlspecialchars($quote['requestDate']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <a href="index.php" class="btn btn-primary mt-3">Get New Quote</a>
            <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
        </div>
    </div>
</body>
</html>
