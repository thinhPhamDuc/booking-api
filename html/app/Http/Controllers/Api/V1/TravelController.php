<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use App\Jobs\SendWelcomeEmail;
use App\Models\Product;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;

class TravelController extends Controller
{
    public function index(){
        return TravelResource::collection(Travel::where('is_public',true)->paginate());
    }

    public function transactions(){
        return Transaction::query()->cursorPaginate();
    }

    public function products(){
        return Product::create([
            'loan_id' => 3,
            'user_id' => 2,
        ]);
    }

    public function processQueue(){
        $emailJob = new SendWelcomeEmail();
        dispatch($emailJob);
    }

    public function importExcel(ExcelRequest $request){
        $data = Excel::toArray([], $request->file('file'));

        return $data;
    }
}
