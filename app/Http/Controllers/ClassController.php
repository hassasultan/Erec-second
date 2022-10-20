<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\UserClasses;
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

            return true;
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }
    }
}
