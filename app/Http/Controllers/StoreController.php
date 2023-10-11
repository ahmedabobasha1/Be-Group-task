<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class StoreController extends Controller
{
    public function Stores_list(Request $request)
    {


        if (!$request->header('lang')) {
            return response()->json(['massege' => 'please send lang']);
        }

        if ($request->header('lang') != 'ar' &&  $request->header('lang') != 'en') {
            return response()->json(['massege' => 'invalid lang header']);
        }


        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        //  customer's latitude and longitude
        $customerLat = $request->all()['lat'];
        $customerLng = $request->all()['lng'];

        $nearestBranch = Branch::select('id', 'store_id', 'name_ar', 'name_en', DB::raw("(POW(($customerLat - lat), 2) + POW(($customerLng - lng), 2)) as distance"))
            ->orderBy('distance')
            ->limit(2)
            ->get();

        return response()->json(["status" => "success", 'data' => BranchResource::collection($nearestBranch)]);
    }
}
