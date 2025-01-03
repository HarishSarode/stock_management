<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StockData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    public function list(Request $request) {
        try {
            $limit = $request->limit ?? 10;
            $offset = $request->offset ?? 0;
            $stocks = StockData::skip($offset)->take($limit)->get()->toArray();
            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $stocks
            ]);
        } catch (\Exception $e) {
            Log::error('Stock list API error : ' . $e->getMessage());
            return response()->json([
                'status' => 400,
                'error' => true,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function delete($id) {
        try {
            $stocks = StockData::where('id', $id)->first();
            if (!$stocks) {
                return response()->json([
                    'status' => 400,
                    'error' => true,
                    'message' => 'Stock not found'
                ]);
            }
            $stocks->delete();
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Stock deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Stock delete API error : ' . $e->getMessage());
            return response()->json([
                'status' => 400,
                'error' => true,
                'message' => 'Something went wrong!'
            ]);
        }
    }
}
