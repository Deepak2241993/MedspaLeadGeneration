<?php

// app/Http/Controllers/VisitorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Jenssegers\Agent\Agent;

class VisitorController extends Controller
{
    public function store(Request $request)
{
    // Create an instance of the Agent class
    $agent = new Agent();

    // Try to find a visitor by their IP address
    $visitor = Visitor::where('ip_address', $request->ip())->first();

    // Get the city using the geolocation service
    $geoService = new YourGeoServiceClass(); // Replace with your actual geolocation service
    $city = $geoService->getCity($request->ip());

    if ($visitor) {
        // Increment the visit count if the visitor exists
        $visitor->increment('visit_count');
    } else {
        // Create a new visitor if they don't exist
        $visitor = Visitor::create([
            'ip_address' => $request->ip(),
            'browser' => $request->header('User-Agent'),
            'city' => $city, // Add the city information
            'visit_count' => 1,
        ]);
    }

    return response()->json(['message' => 'Visitor information stored.']);
}
}
