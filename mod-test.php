<?php
// Simple test to check if mod_headers is working
header('X-Test-Header: ModHeaders-Working');
?>
<!DOCTYPE html>
<html>
<head><title>Module Test</title></head>
<body>
    <h1>Module Test</h1>
    <p>Check browser DevTools → Network tab → Response Headers for "X-Test-Header"</p>
</body>
</html>