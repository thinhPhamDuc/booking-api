<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class TravelController extends Controller
{
    public function index(){
        $cacheKey = 'travels_public';
        $minutes = 60; // Set the cache expiration time according to your requirements

        if (Cache::has($cacheKey)) {
            $travels = Cache::get($cacheKey);
        } else {
            $travels = Travel::where('is_public', true)->paginate();
            Cache::put($cacheKey, $travels, $minutes);
        }

        return TravelResource::collection($travels);
    }
    
    public function create()
    {
        // Create the new travel record

        $cacheKey = 'travels_public';
        Cache::forget($cacheKey);

        // Return the response
    }
}
