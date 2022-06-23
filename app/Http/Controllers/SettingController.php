<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Controllers\Api\SettingController as ApiSettingController;
use App\Models\File as Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $apiRequest = new Request; 
            ([
                'country_id' => $request->country_id,
            ]);      

        $company_list = new ApiSettingController;
        $list = $company_list->get_user_detail($apiRequest);
        $response = json_decode($list->content(), true);
        $success = $response["success"];
        $message = $response["message"];
        $data = $response["result"];
        if ($success == 1) {
            return view('index', compact('data'))->with('success', $message);
        }
        return redirect()->back()->with('error', $message);
    }

    public function filter(Request $request)
    {
        $apiRequest = new Request; 
            ([
                'country_id' => $request->country_id,
            ]); 
            
        $apiRequest->country_id = $request->country_id;

        $company_list = new ApiSettingController;
        $list = $company_list->get_user_detail($apiRequest);
        $response = json_decode($list->content(), true);
        $success = $response["success"];
        $message = $response["message"];
        $data = $response["result"];
      
        if ($success == 1) {
            return view('index', compact('data'))->with('success', $message);
        }
        return redirect()->back()->with('error', $message);
    }

    public function pdf_index(){

        $file_data = Files::get();

        return view('file.index',compact('file_data'));
    }

    public function pdf_upload(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'file' => 'required|mimes:pdf',
        ],[
            'file.required' => 'File is required',
            'file.mimes' => 'Pdf type file required',
        ]);

        if ($validator->fails())
        {           
            return response()->json(['success' => 0, 'message' => "File is not PDF" , "result" => []], 415);
        }
        
        $file_name = $request->file->getClientOriginalName();
        $file_size = $request->file->getSize();

        if(strpos($file_name, "Proposal") == false){

            return response()->json(['success' => 0, 'message' => "file doesn't contain the word proposal" , "result" => []], 422);

        }  

        $pdfURL = "";

        if ($request->hasFile('file')) {
            $pdf = $request->file->getClientOriginalName();
            $filePath = "uploads/pdf";
            if (!\Illuminate\Support\Facades\File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $request->file->move($filePath, $pdf);

            $pdfURL = asset($filePath) . '/' . $pdf;
        }

      $file_data = Files::where('name',$pdfURL)->where('size',$file_size)->first();
      if ($file_data != "") {

            $file_data->name = $pdfURL;
            $file_data->size = $file_size;
            $file_data->update();

            return redirect()->back()->with('success', 'File Updated Successfully ');

            // return response()->json(['success' => 1, 'message' => "file succefully updated" , "result" => []]);

      
      }else {

        $file_data = new Files;
        $file_data->name = $pdfURL;
        $file_data->size = $file_size;
        $file_data->save();

        return redirect()->back()->with('success', 'New File Stored Successfully ');

        // return response()->json(['success' => 1, 'message' => "file succefully Stored" , "result" => []]);

      }
    }
}
