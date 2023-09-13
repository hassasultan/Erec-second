<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\UserClasses;
use App\Models\NewUserClasses;
use App\Models\QstToClasses;
use App\Models\Qst;
use App\Models\QstScore;
use Exception;
use Illuminate\Support\Str;


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
        $class = Classes::where('class_id', $request->class_id)->first();
        return $class;
    }
    public function create_Class(Request $request)
    {
        # code...
        try
        {
            $valid = $this->validate($request, [
                'name'  =>  'required|string|unique:classes,class_name',
            ]);
            $slug  = Str::slug($request->name);
            $class = new Classes;
            $class->class_name = $request->name;
            $class->org_id = 32;
            $class->institution_id = $slug;
            $class->save();
            return $class;
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    public function update_Class(Request $request)
    {
        # code...
        try
        {
            $valid = $this->validate($request, [
                'class_id'  =>  'required|numeric|exists:classes,class_id',
            ]);
            $slug  = Str::slug($request->name);
            $class = Classes::where('class_id',$request->class_id)->first();
            dd($class->toArray());
            if($request->has('name'))
            {
                $class->class_name = $request->name;
                $class->institution_id = $slug;
            }
            $class->save();
            return $class;
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    public function createUserClass(Request $request)
    {
        try {
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
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function qstClasses(Request $request)
    {
        $class_id = $request->class_id;
        $qsts = Qst::with('qstToClassNew')->whereHas('qstToClassNew', function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        })->get();
        return $qsts;
    }

    public function qst(Request $request)
    {
        $qsts = Qst::with('qstToClassNew')->where('number', $request->id)->first();
        return $qsts;
    }
    public function qstSocre(Request $request)
    {
        $score = QstScore::with('qst')->where('qst', $request->qst)->where('u_id', $request->user_id)->first();
        return $score;
    }
}
