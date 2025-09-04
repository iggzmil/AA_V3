<?php
/**
 * Security Headers for Nginx
 * Include this at the top of your PHP files
 */

// Prevent clickjacking attacks
header('X-Frame-Options: SAMEORIGIN');

// Prevent MIME-type confusion attacks  
header('X-Content-Type-Options: nosniff');

// Enable XSS protection in browsers
header('X-XSS-Protection: 1; mode=block');

// Control referrer information leakage
header('Referrer-Policy: strict-origin-when-cross-origin');
?>