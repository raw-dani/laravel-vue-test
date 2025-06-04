<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function serverInfo()
    {
        return response()->json([
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'server_time' => now()->format('Y-m-d H:i:s'),
            'environment' => app()->environment(),
        ]);
    }

    public function test()
    {
        return response()->json([
            'message' => 'API is working! Laravel backend connected successfully.',
            'timestamp' => now()->toISOString(),
        ]);
    }

    public function testDatabase()
    {
        try {
            DB::connection()->getPdo();
            
            // Test query
            $result = DB::select('SELECT 1 as test');
            
            return response()->json([
                'success' => true,
                'message' => 'Database connection successful!',
                'driver' => config('database.default'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database connection failed: ' . $e->getMessage(),
            ]);
        }
    }
}
