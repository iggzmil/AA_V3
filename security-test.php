<?php
/**
 * Security Headers Test Tool
 * Displays the HTTP headers being sent by the server
 */

// Apply security headers (for Nginx)
include 'security-headers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Headers Test - Auto Acoustics</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #db2d2e; margin-bottom: 20px; }
        .header-item { margin: 10px 0; padding: 10px; background: #f8f8f8; border-radius: 4px; }
        .header-name { font-weight: bold; color: #333; }
        .header-value { color: #666; font-family: monospace; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; }
        .info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; }
        .test-button { background: #db2d2e; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔒 Security Headers Test</h1>
        
        <div class="info">
            <strong>Instructions:</strong> 
            <ol>
                <li>Check if the security headers are present below</li>
                <li>Use browser Developer Tools → Network tab to verify headers</li>
                <li>Delete this file after testing for security</li>
            </ol>
        </div>

        <h2>Current Response Headers</h2>
        
        <?php
        // Get headers that will be sent
        $headers = [];
        
        // Check if headers_list() is available (after content is sent)
        if (function_exists('headers_list')) {
            $sentHeaders = headers_list();
            foreach ($sentHeaders as $header) {
                if (strpos($header, ':') !== false) {
                    list($name, $value) = explode(':', $header, 2);
                    $headers[trim($name)] = trim($value);
                }
            }
        }
        
        // Expected security headers
        $securityHeaders = [
            'X-Frame-Options' => 'SAMEORIGIN',
            'X-Content-Type-Options' => 'nosniff', 
            'X-XSS-Protection' => '1; mode=block',
            'Referrer-Policy' => 'strict-origin-when-cross-origin'
        ];
        
        echo "<h3>Security Headers Status:</h3>";
        
        foreach ($securityHeaders as $headerName => $expectedValue) {
            $isPresent = isset($headers[$headerName]);
            $actualValue = $isPresent ? $headers[$headerName] : 'Not Set';
            $isCorrect = $isPresent && $headers[$headerName] === $expectedValue;
            
            $class = $isCorrect ? 'success' : ($isPresent ? 'warning' : 'warning');
            $status = $isCorrect ? '✅ Correct' : ($isPresent ? '⚠️ Present but different' : '❌ Missing');
            
            echo "<div class='header-item $class'>";
            echo "<div class='header-name'>$headerName: $status</div>";
            echo "<div class='header-value'>Expected: $expectedValue</div>";
            echo "<div class='header-value'>Actual: $actualValue</div>";
            echo "</div>";
        }
        
        echo "<h3>All Headers Being Sent:</h3>";
        foreach ($headers as $name => $value) {
            echo "<div class='header-item'>";
            echo "<span class='header-name'>$name:</span> ";
            echo "<span class='header-value'>$value</span>";
            echo "</div>";
        }
        ?>
        
        <div class="info" style="margin-top: 20px;">
            <strong>Testing Tips:</strong><br>
            • Open browser DevTools (F12) → Network tab<br>
            • Refresh this page<br>
            • Click on the request to see response headers<br>
            • Verify the security headers are present<br>
        </div>
        
        <div class="warning" style="margin-top: 20px;">
            <strong>⚠️ Security Notice:</strong> Delete this file after testing to prevent information disclosure.
        </div>
    </div>
</body>
</html>