<?php
// Temporary debug file to check paths
echo "<h3>Path Debug Information</h3>";

echo "<p><strong>Current directory (__DIR__):</strong> " . __DIR__ . "</p>";

$checkPaths = [
    __DIR__ . '/vendor/autoload.php',
    __DIR__ . '/../vendor/autoload.php', 
    __DIR__ . '/../../vendor/autoload.php',
    __DIR__ . '/../../../vendor/autoload.php',
    __DIR__ . '/../../../../vendor/autoload.php'
];

echo "<h4>Checking autoloader paths:</h4>";
foreach ($checkPaths as $path) {
    $exists = file_exists($path);
    echo "<p>" . $path . " - " . ($exists ? "<strong style='color:green'>EXISTS</strong>" : "<span style='color:red'>NOT FOUND</span>") . "</p>";
    
    if ($exists) {
        echo "<p style='margin-left: 20px;'>✅ This is the correct path to use!</p>";
        break;
    }
}

echo "<h4>Current working directory:</h4>";
echo "<p>" . getcwd() . "</p>";

echo "<h4>Directory listing of current location:</h4>";
$files = scandir(__DIR__);
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo "<p>" . $file . (is_dir(__DIR__ . '/' . $file) ? ' (directory)' : ' (file)') . "</p>";
    }
}
?>