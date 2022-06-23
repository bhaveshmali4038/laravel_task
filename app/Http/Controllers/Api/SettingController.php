<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function get_user_detail(Request $request)
    {
        try {

            $company_list = Company::with(['user_details','country_details'])->latest();
             
            if (!empty($request->country_id)) {

                $company_list = $company_list->where('country_id',$request->country_id);              
                
            }
            $company_list = $company_list->get();  

            $data = [];

            foreach ($company_list as $key => $value) {
                $data[$key]['id'] = $value->id ?? "";
                $data[$key]['company_name'] = $value->name ?? "";
                $data[$key]['country_name'] = $value->country_details->name ?? "";
                $data[$key]['user_name'] = $value->user_details->name ?? "";
                $data[$key]['date'] = date('d-m-Y', strtotime($value->created_at));
            }

            return Helper::returnresponse(1, "Get All Users Details", $data);
        } catch (\Exception$e) {
            return Helper::returnresponse(0, $e->getMessage(), []);
        }

    }
}
