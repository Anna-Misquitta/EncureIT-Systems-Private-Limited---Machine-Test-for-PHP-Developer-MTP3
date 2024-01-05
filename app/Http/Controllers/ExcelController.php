<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Excel;

class ExcelController extends Controller
{
    public function storeExcel()
    {
        $url = 'https://opencontext.org/query/Asia/Turkey/Kenan+Tepe.json';

        try {
            $response = Http::get($url);
            if ($response->successful()) {
                $data = $response->json();
                $get_all_ids = [];
                array_walk_recursive($data, function ($value, $key) use (&$get_all_ids) {
                    if ($key === 'id' && !in_array($value, $get_all_ids)) {
                        $get_all_ids[] = [$value];
                    }
                });
                return Excel::download(new ExcelExport($get_all_ids), 'exported_data.xlsx');
            } else {
                $statusCode = $response->status();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
