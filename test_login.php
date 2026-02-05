<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;

echo "=== Testing User Login ===\n\n";

// Test dengan email admin
echo "1. Testing login with admin account:\n";
$credentials = [
    'email' => 'admin@laundry.com',
    'password' => 'password'
];

if (Auth::attempt($credentials)) {
    echo "   ✓ Login successful!\n";
    echo "   User: " . Auth::user()->name . "\n";
    echo "   Role: " . Auth::user()->role . "\n";
} else {
    echo "   ✗ Login failed\n";
}

Auth::logout();

// Test dengan email customer
echo "\n2. Testing login with customer account:\n";
$credentials = [
    'email' => 'test@example.com',
    'password' => 'password123'
];

if (Auth::attempt($credentials)) {
    echo "   ✓ Login successful!\n";
    echo "   User: " . Auth::user()->name . "\n";
    echo "   Role: " . Auth::user()->role . "\n";
} else {
    echo "   ✗ Login failed\n";
}

Auth::logout();

// Test password salah
echo "\n3. Testing login with wrong password:\n";
$credentials = [
    'email' => 'test@example.com',
    'password' => 'wrongpassword'
];

if (Auth::attempt($credentials)) {
    echo "   ✗ Should have failed but passed!\n";
} else {
    echo "   ✓ Correctly rejected wrong password\n";
}
