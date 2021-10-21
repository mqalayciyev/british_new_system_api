<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    function createSlug($str) {
        $search = array('ə', 'Ə', 'ç', 'Ç', 'Ș', 'ü', 'Ü', 'ö', 'Ö', 'ğ', 'Ğ', 'ı', 'Ț', 'ş', 'ţ', 'Ş', 'Ţ', 'ș', 'ț', 'î', 'â', 'ă', 'Î', 'Â', 'Ă', 'ë', 'Ë');
        $replace = array('e', 'E', 'c', 'C', 's', 'u', 'U', 'o', 'O', 'g', 'G', 'i', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E');
        $str = str_ireplace($search, $replace, strtolower(trim($str)));
        $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
        $str = str_replace(' ', '-', $str);
        return preg_replace('/\-{2,}/', '-', $str);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'email.required'  => 'Email Bos ola bilmez.',
            'email.email'  => 'Duzgun email formasi daxil edin.',
            'password.required'  => 'Sifre bos ola bilmez.',
            'password.min'  => 'Sifre minimum 8 simvol omalidir.',
        ];
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'email' => Rule::unique('companies')->ignore($id),
            'name' => 'required|min:3',
            'mobile' => 'required',
            'currency' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        Company::where('id', $id)->update($request->all());
        $company = Company::where('id', $id)->first();
        return response()->json(['status' => 'success', 'company' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function add_image (Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $company = Company::find($request->user()->company);
        $file = $request->file('file');

        $name= strtolower($company->name) . '_logo_' .time().'.'.$file->getClientOriginalExtension();
        $path = public_path().'/assets/' . $this->createSlug($company->name);
        if (!File::exists($path))
        {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file->move(public_path('assets/' . $this->createSlug($company->name)), $name);


        $file_url = asset('assets/' . $this->createSlug($company->name));
        $url = $file_url . '/' .$name;

        $image = explode('/', $company->logo);
        $count = count($image);
        Storage::delete("assets/".$this->createSlug($company->name).'/'.$image[$count-1]);

        Company::where('id', $request->user()->company)->update([
            'logo' => $url
        ]);
        $company = Company::where('id', $request->user()->company)->first();
        return response()->json(['status' => 'success', 'company' => $company, 'image' => $url]);

    }
    public function delete_image (){
        $company = Company::find(request()->user()->company);
        $image = explode('/', $company->logo);
        $count = count($image);
        if(File::exists(public_path('assets/' . $this->createSlug($company->name).'/'.$image[$count-1]) ) ){

            File::delete(public_path('assets/' . $this->createSlug($company->name).'/'.$image[$count-1]) );

        }

        Company::where('id', request()->user()->company)->update([
            'logo' => ''
        ]);
        $company = Company::where('id', request()->user()->company)->first();
        return response()->json(['status' => 'success', 'company' => $company]);

    }
}
