<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

echo "=== Testing User Registration ===\n\n";

// Check existing users
echo "1. Existing users in database:\n";
$users = DB::table('users')->get(['id', 'name', 'email', 'role']);
foreach($users as $user) {
    echo "   - {$user->name} ({$user->email}) - Role: {$user->role}\n";
}

if($users->isEmpty()) {
    echo "   No users found.\n";
}

echo "\n2. Testing User Creation:\n";
try {
    $newUser = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
        'role' => 'customer'
    ]);
    echo "   ✓ User created successfully!\n";
    echo "   ID: {$newUser->id}\n";
    echo "   Name: {$newUser->name}\n";
    echo "   Email: {$newUser->email}\n";
    echo "   Role: {$newUser->role}\n";
} catch(Exception $e) {
    echo "   ✗ Error: {$e->getMessage()}\n";
}

echo "\n3. Final users count: " . DB::table('users')->count() . "\n";
