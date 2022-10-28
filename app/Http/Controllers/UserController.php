<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoggedIn;
use App\Models\AccessToQst;
use App\Models\QstAttempts;
use App\Models\QstToClasses;
use App\Models\PostedQst;
use App\Traits\SaveImage;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



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
    public function loggedInCreate(Request $request)
    {
        // dd($request->all());
        try
        {
            $check = LoggedIn::where('u_id',$request->u_id)->where('u_type',$request->u_type);
            if($check->count() > 0)
            {
                $check = $check->get();
                foreach($check as $row)
                {
                    LoggedIn::where('u_id',$row->u_id)->where('u_type',$row->u_type)->delete();
                }
            }
            $logged = new LoggedIn();
            $logged->u_id = $request->u_id;
            $logged->u_type = $request->u_type;
            $logged->session_id = $request->session_id;
            $logged->log_time = $request->log_time;
            $logged->save();
            return true;
        }
        catch(Exception $ex)
        {
            return response()->json(['error'=>$ex->getMessage()]);
        }

    }
    public function loggedInDelete(Request $request)
    {
        // dd($request->all());
        try
        {
            $check = LoggedIn::where('u_id',$request->u_id)->where('u_type',$request->u_type);
            if($check->count() > 0)
            {
                $check = $check->get();
                foreach($check as $row)
                {
                    LoggedIn::where('u_id',$row->u_id)->where('u_type',$row->u_type)->delete();
                }
            }
            return true;
        }
        catch(Exception $ex)
        {
            return response()->json(['error'=>$ex->getMessage()]);
        }

    }
    public function assignCandidate(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $check = AccessToQst::where('qst_no',$request->qst_no)->where('u_id',$request->u_id)->count();
            if($check == 0)
            {
                $assign = new AccessToQst();
                $assign->qst_no = $request->qst_no;
                $assign->u_id = $request->u_id;
                $assign->org_id = 32;
                $assign->save();
                $attempt = new QstAttempts();
                $attempt->qst_no = $request->qst_no;
                $attempt->u_id = $request->u_id;
                $attempt->attempts = 0;
                $attempt->org_id = 32;
                $attempt->start_time = 0;
                $attempt->start_day = 0;
                $attempt->start_month = 0;
                $attempt->finish_time = 0;
                $attempt->finish_day = 0;
                $attempt->finish_month = 0;
                $attempt->end = 0;
                $attempt->resume = 0;
                $attempt->save();
                $checkTwo = QstToClasses::where('qst',$request->qst_no)->where('class_id',$request->class_id)
                ->where('type',1)
                ->where('org_id',32)->count();
                if($checkTwo == 0)
                {
                    $toClasses = new QstToClasses();
                    $toClasses->qst = $request->qst_no;
                    $toClasses->class_id = $request->class_id;
                    $toClasses->type = 1;
                    $toClasses->org_id = 32;
                    $toClasses->save();

                }
                $checkThree = PostedQst::where('qst',$request->qst_no)->where('class_id',$request->class_id)->count();
                if($checkThree == 0)
                {
                    $posted = new PostedQst();
                    $posted->qst = $request->qst_no;
                    $posted->attempts = 10;
                    $posted->start = "1000-01-01";
                    $posted->end = "1000-01-01";
                    $posted->class_id = $request->class_id;
                    $posted->result = 0;
                    $posted->submissions = 0;
                    $posted->rhm = 0;
                    $posted->forall = 0;
                    $posted->u_id = 82;
                    $posted->posted = 1;
                    $posted->org_id = 32;
                    $posted->avail = 1;
                    $posted->start_month = 1;
                    $posted->start_day = 1;
                    $posted->start_hour = 1245;
                    $posted->finish_month = 1;
                    $posted->finish_day = 1;
                    $posted->finish_hour = 1245;
                    $posted->qtime = 60;
                    $posted->delivery = 1;
                    $posted->branching = 0;
                    $posted->shuffle = 0;
                    $posted->display = 0;
                    $posted->save();
                }
                DB::commit();
                // if($assign && $attempt && $toClasses)
                // {
                    return true;
                // }
                // else
                // {
                //     return false;
                // }
            }
            else
            {
                return response()->json(['status'=>false , 'message'=>"Test is already assigned to this user..."]);
            }

        }
        catch(Exception $ex)
        {
            // return $ex;

            DB::rollback();
            return response()->json(['error'=>$ex->getMessage()]);
        }
    }
}
