<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\StockController as ApiStockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use DataTables;
use Yajra\DataTables\DataTables as DataTablesDataTables;

class StockController extends Controller
{
    public function list(Request $request) {
        try {
            // dD('hii');
            // $loginApi = 'http://127.0.0.1:8000/api/stock/list';
            // $httpClient = Http::get($loginApi);

            $stocks = ApiStockController::list($request);
            $data = $stocks->getOriginalContent();
            // if (isset($data['error'])) {
            //     return back()->with('error', $data['message']);
            // }
            $stocks = $data['data'];
            if ($request->ajax()) {
                return DataTablesDataTables::of($stocks)->addColumn('action', function($stock) {
                    return '<button type="button" class="btn btn-primary btn-sm deleteStock" data-id="'.$stock['id'].'">Delete</button>';
                })->rawColumns(['action'])->make(true);
            }
            return view('admin.layouts.main', compact('stocks'));
        } catch (\Exception $e) {
            Log::error('Stock List API error : ' . $e->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function delete($id) {
        try {
            // dD('hii');
            // $loginApi = 'http://127.0.0.1:8000/api/stock/list';
            // $httpClient = Http::get($loginApi);

            $stocks = ApiStockController::delete($id);
            $data = $stocks->getOriginalContent();
            if (isset($data['error'])) {
                return response()->json([
                    'status' => 400,
                    'error' => true,
                    'message' => $data['message']
                ]);
            }
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Stock deleted successfully!'
            ]);
            // return back()->with('success', 'Stock deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Stock List API error : ' . $e->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }
}
