<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\UserClasses;
use App\Models\NewUserClasses;
use App\Models\QstToClasses;
use Exception;

class ClassController extends Controller
{
    //
    public function index()
    {
        $classes = Classes::all();
        return $classes;
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
        $qsts = QstToClasses::where('class_id',$request->class_id)->get();
        return $qsts;
    }
}
