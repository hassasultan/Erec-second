<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\UserClasses;
use App\Models\NewUserClasses;
use App\Models\QstToClasses;
use App\Models\Qst;
use Exception;

class ClassController extends Controller
{
    //
    public function index()
    {
        $classes = Classes::all();
        return $classes;
    }
    public function SpecificClass(Request $request)
    {
        # code...
        $class = Classes::where('class_id',$request->class_id)->first();
        return $class;
    }
    public function createUserClass(Request $request)
    {
        try
        {
            $UserClass = new UserClasses;
            $UserClass->u_id = $request->u_id;
            $UserClass->class_id = $request->class_id;
            $UserClass->org_id = 32;
            $UserClass->save();

            $newUserClass = new NewUserClasses;
            $newUserClass->u_id = $request->u_id;
            $newUserClass->class_id = $request->class_id;
            $newUserClass->org_id = 32;
            $newUserClass->save();

            return true;
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }
    }
    public function qstClasses(Request $request)
    {
        $class_id = $request->class_id;
        $qsts = Qst::with('qstToClassNew')->whereHas('qstToClassNew',function($query) use($class_id)
        {
            $query->where('class_id',$class_id);
        })->get();
        return $qsts;
    }

    public function qst(Request $request)
    {
        $qsts = Qst::with('qstToClassNew')->where('number',$request->id)->first();
        return $qsts;
    }
}
