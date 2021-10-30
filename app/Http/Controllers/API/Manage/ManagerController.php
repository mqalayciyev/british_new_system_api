<?php

namespace App\Http\Controllers\API\Manage;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
// use Intervention\Image\Facades\Image;
use Image;

class ManagerController extends Controller
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
        $manager = User::leftJoin('offices', 'offices.id', 'users.office')
            ->select('users.*', "offices.id as office_id", 'offices.name')
            ->where('users.company', request()->user()->company)
            ->where('users.login', 1)
            ->where('users.id', '!=', request()->user()->id)
            ->get();
        return response()->json(['status' => 'success', 'managers' => $manager]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'permission.required'  => 'Sessia qeyd edilməyib.',
            'email.required'  => 'Email Bos ola bilmez.',
            'email.email'  => 'Duzgun email formasi daxil edin.',
            'password.required'  => 'Sifre bos ola bilmez.',
            'password.min'  => 'Sifre minimum 8 simvol omalidir.',
        ];
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|',
            'password' => 'required|min:8',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'office' => 'required|exists:offices,id',
            'mobile' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $user = User::where('email', request('email'))->where('company', request()->user()->company)->first();
        if($user){
            return response()->json(['status' => 'error', 'message' => ['Bu istifadeci sistemde movcuddur: '.  request('email')]]);
        }

        $data = request()->all();
        $data['login'] = request('type');
        $data['company'] = request()->user()->company;
        $data['added_by'] = request()->user()->id;
        $data['password'] = Hash::make(request('password'));
        User::create($data);



        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id > 0){
            $manager =User::where('id', $id)->where('company', request()->user()->company)->first();
            return response()->json(['status' => 'success', 'manager' => $manager]);
        }
        else{
            return response()->json(['status' => 'error', 'message' => 'Istifadeci tapilmadi']);
        }
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
            'password.min'  => 'Sifre minimum 8 simvol omalidir.',
        ];
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'email' => Rule::unique('users')->ignore($id),
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            // 'office' => 'required|exists:offices,id',
            'mobile' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $user = User::where('email', request('email'))->where('company', request()->user()->company)->where('id', '!=', $id)->first();
        if($user){
            return response()->json(['status' => 'error', 'message' => ['Bu email sistemde movcuddur: '.  request('email')]]);
        }
        $data = $request->except('password', 'office_id', 'name', 'created_at', 'deleted_at', 'updated_at');
        // return response()->json($data);
        if($request->password !== null && strlen($request->password) < 8){
            return response()->json(['status' => 'error', 'message' => ['The password must be at least 8 characters long.']]);
        }
        if($request->password !== null){
            $data['password'] = Hash::make($request->password);
        }
        $data['login'] = request('type');

        User::where('id', $id)->update($data);
        $user = User::where('id', $id)->first();
        return response()->json(['status' => 'success', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->where('company', request()->user()->company)->delete();
        return response()->json(['status' => 'success', 'message' => 'Məlumat silindi']);
    }

    public function owner (){
        $manager = User::where('company', request()->user()->company)->where('type', '!=', 3)->get();
        return response()->json(['status' => 'success', 'owner' => $manager]);
    }
    public function add_image (Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
            'id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $company = Company::find($request->user()->company);
        $file = $request->file('file');
        // $file = $request->file;

        $name= strtolower($request->user()->first_name) . '_' . strtolower($request->user()->last_name) . '_profile_' .time().'.webp';
        // $file->move('assets/' . $this->createSlug($company->name), $name);
        // $request->file->storeAs('files/' . $this->createSlug($company->name), $name);
        $path = public_path().'/assets/' . $this->createSlug($company->name) . '/profile';
        if (!File::exists($path))
        {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file_url = 'assets/' . $this->createSlug($company->name) . '/profile';
        $url = $file_url . '/' .$name;




        $square = Image::canvas(500, 500, array(255, 255, 255, 0));



        $img = Image::make($file->getRealPath())
            ->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });



        $square->insert($img, 'center');

        $path = public_path('assets/' . $this->createSlug($company->name) . '/profile/' .$name);

        // return response()->json($path);

        $square->save($path);





        $user  = User::find($request->id);
        $image = explode('/', $user->image);
        $count = count($image);
        if(File::exists(public_path('assets/' . $this->createSlug($company->name).'/profile/'.$image[$count-1]) ) ){

            File::delete(public_path('assets/' . $this->createSlug($company->name).'/profile/'.$image[$count-1]) );

        }


        User::where('id', $request->id)->update([
            'image' => $url
        ]);

        $user = User::where('id', $request->id)->first();

        return response()->json(['status' => 'success', 'user' => $user, 'image' => $url]);

    }
    public function delete_image ($id){

        $company = Company::find(request()->user()->company);
        $user  = User::find($id);
        $image = explode('/', $user->image);
        $count = count($image);
        if(File::exists(public_path('assets/' . $this->createSlug($company->name).'/profile/'.$image[$count-1]) ) ){

            File::delete(public_path('assets/' . $this->createSlug($company->name).'/profile/'.$image[$count-1]) );

        }
        User::where('id', $id)->update([
            'image' => ''
        ]);
        $user = User::where('id', $id)->first();
        return response()->json(['status' => 'success', 'user' => $user]);

    }

    public function change_password(Request $request){

        // return response()->json($request->all());

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
            'old_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail("Köhnə şifrə düzgün daxil edilməyib.");
                }
            }]
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        User::where('id', request('id'))->update([
            'password' => Hash::make(request('password')),
        ]);

        return response()->json(['status' => 'success']);
    }
}
