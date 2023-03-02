<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get_company_detail(Request $request)
    {
        try {

            $company_list = Company::with(['user','country'])->orderByDesc('id')->get();
            $data = [];
            foreach ($company_list as $key => $value) {
                $data[$key]['id'] = $value->id ?? "";
                $data[$key]['company_name'] = $value->name ?? "";
                $data[$key]['user_name'] = $value->user->name ?? "";
                $data[$key]['country_name'] = $value->country->name ?? "";
                $data[$key]['date'] = date('Y-m-d', strtotime($value->created_at));
            }

            return response()->json(['success' => 1, 'message' => "Get All Users Details" , "result" => $data], 200);
        } catch (\Exception$e) {
            return response()->json(['success' => 0, 'message' => $e->getMessage() , "result" => []], 400);
        }

    }
}
