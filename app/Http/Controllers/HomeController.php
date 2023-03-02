<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\File;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {       
        $country = Country::get();
        return view('company.index',compact('country'));
    }

    public function company_ajax(Request $request)
    { 
        if(!empty($request->country)){
            $company = Company::with('user','country')->whereHas('country', function ($company) use ($request) {
                $company->where('id', $request->country);
            })->get();
        }else{
            $company = Company::with('user','country')->get();
        }         

        $table = DataTables::of($company)
        ->editColumn('id', function ($company) {    
            return $company->id;
        })
        ->editColumn('company_name', function ($company) {
            return $company->name ?? "";
        })
        ->editColumn('user_name', function ($company) {
            return $company->user->name ?? "";
        })
        ->editColumn('country_name', function ($company) {
            return $company->country->name ?? "";
        })  
        ->editColumn('date', function ($company) {
            return date('Y-m-d', strtotime($company->created_at));
        })      
        ->make(true);
    return $table;
    }

    public function pdf_index(Request $request)
    {       
        return view('pdf.index');
    }

    public function pdf_ajax(Request $request)
    {        
        $file = File::get();        

        $table = DataTables::of($file)
        ->editColumn('id', function ($file) {    
            return $file->id;
        })
        ->editColumn('file_name', function ($file) {
            return $file->name ?? "";
        })
        ->editColumn('file_size', function ($file) {
            return $file->size ?? "";
        })         
        ->make(true);
        return $table;
    }

    public function pdf_upload(Request $request)
    {       
        $validator = Validator::make($request->all(),
        [
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails())
        {           
            return response()->json(['success' => 0, 'message' => "File is not PDF" , "result" => []], 415);
        }

        $file_name = $request->file->getClientOriginalName();
        $file_size = $request->file->getSize();
        if(Str::contains($file_name, "Proposal") == false){       
            return response()->json(['success' => 0, 'message' => "file doesn't contain the Proposal word" , "result" => []], 422);
        }

        $file_data = File::where('name',$file_name)->where('size',$file_size)->first();
        if (!empty($file_data)) {
                $file_data->name = $file_name;
                $file_data->size = $file_size;
                $file_data->update();
                return redirect()->back()->with('success', 'File Updated Successfully ');      
        }else {
            $file_data = new File;
            $file_data->name = $file_name;
            $file_data->size = $file_size;
            $file_data->save();

            return redirect()->back()->with('success', 'New File Stored Successfully ');
        }
    }

}
