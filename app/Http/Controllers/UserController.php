<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\SaveImage;
use Exception;
use Illuminate\Support\Str;


class UserController extends Controller
{
    use SaveImage;
    //
    public function create(Request $request)
    {
        // dd(env('APP_URL'));
        try
        {
            $image = NULL;
            $slug  = Str::slug($request->name.$request->lname);
            $letter = str_split($request->lname);
            if($request->hasFile('photo'))
            {
                $image  = $this->UserImage($request->photo);
            }
            $data = [
                'u_type' => 3,
                'f_name' => $request->name,
                'm_name'=> $request->name,
                'l_name'=> $request->lname,
                'u_name'=> $slug,
                'pass'   => "{X-PBKDF2}HMACSHA2+256:AAAD6A:zQMwAA==:djJr/w3qlfgGIEsWO5FM95iQSFepf398PkUIvNuAE9I=",
                'org_id'=> 32,
                'letter'=> $letter[0],
                'institute_id'=> 1,
                'email'=> $request->email,
                'photo'=> $image,
            ];
            // dd($data);
            $user = User::create($data);
            if($user)
            {
                return  $user;
            }
            else
            {
                return response()->json(['error'=>"Something Went Wrong..."]);
            }

        }
        catch(Exception $ex)
        {
            // dd($ex->getMessage());
            return response()->json(['error'=>$ex->getMessage()]);
        }

    }
}