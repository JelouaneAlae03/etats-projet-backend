<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class UpdateDbConfig extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        
        $validated = $request->newConfig;

        $envFile = base_path('.env');
        $envContent = File::get($envFile);

        foreach ($validated as $key => $value) {
            $envContent = preg_replace("/^" . strtoupper($key) . "=.*/m",  strtoupper($key) . "=" . $value, $envContent);
        }

        File::put($envFile, $envContent);

        Artisan::call('config:cache');

        return response()->json(['message' => 'Database settings updated successfully']);
    
    }
}
