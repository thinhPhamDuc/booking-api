<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use App\Jobs\SendWelcomeEmail;

class TravelController extends Controller
{
    public function index(){
        return TravelResource::collection(Travel::where('is_public',true)->paginate());
    }

    public function processQueue(){
        $emailJob = new SendWelcomeEmail();
        dispatch($emailJob);
    }
}
