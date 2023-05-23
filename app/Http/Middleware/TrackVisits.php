<?php 

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TrackVisits
{
    public function handle(Request $request, Closure $next)
    {
        $existingDeviceId = Cookie::get('device_id');

        // If a device ID exists in the cookie, use it
        if ($existingDeviceId) {
            $encryptedId = $existingDeviceId;
        } else {
            // Otherwise, generate a new ID based on the IP address and user data
            $ipAddress = $request->server('REMOTE_ADDR');
            $userData = $request->user() ? $request->user()->toJson() : '{}'; // Convert user data to JSON string

            // Use SHA-256 to hash the IP and user data together
            $uniqueId = hash('sha256', $ipAddress . $userData);

            // Encrypt the hashed value to make it more secure
            $encryptedId = encrypt($uniqueId);

            // Store the encrypted ID in a cookie that never expires
            Cookie::queue('device_id', $encryptedId, 0);
        }

        // Check if a record already exists for this device
        if (!Visit::where('device_id', $encryptedId)->exists()) {
            // No record exists, so create a new one
            Visit::create([
                'device_id' => $encryptedId,
                'updated_ad' => now(),
            ]);
        } else {
            // A record already exists for this device, so update the last visited timestamp
            Visit::where('device_id', $encryptedId)->update(['updated_at' => now()]);
        }

        return $next($request);
    }
}