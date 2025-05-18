<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nearby(Request $request)
    {
        // Get all centers first for initial display
        $centers = Center::where('is_active', true)
            ->orderBy('name')
            ->get();

        // If user has location data, calculate distances
        if (Auth::user()->latitude && Auth::user()->longitude) {
            $radius = $request->radius ?? 20; // Default 20km radius
            $userLat = Auth::user()->latitude;
            $userLng = Auth::user()->longitude;

            $centers = Center::selectRaw("*, 
                ( 6371 * acos( cos( radians(?) ) * 
                    cos( radians( latitude ) ) * 
                    cos( radians( longitude ) - radians(?) ) + 
                    sin( radians(?) ) * 
                    sin( radians( latitude ) ) 
                ) ) AS distance", [$userLat, $userLng, $userLat])
                ->where('is_active', true)
                ->having('distance', '<=', $radius)
                ->orderBy('distance')
                ->get();
        }

        return view('centers.nearby', compact('centers'));
    }

    public function index()
    {
        $centers = Center::orderBy('name')->paginate(10);
        return view('centers.index', compact('centers'));
    }
} 