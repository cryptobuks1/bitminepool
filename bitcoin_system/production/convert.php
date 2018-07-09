<?php
$url = "https://blockchain.info/stats?format=json";
$stats = json_decode(file_get_contents($url), true);
$btcValue = $stats['market_price_usd'];
$usdCost = 100;

$convertedCost = $usdCost / $btcValue;

echo $convertedCost;
?> 