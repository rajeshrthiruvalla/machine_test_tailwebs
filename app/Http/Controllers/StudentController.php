<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    public function validate_input($request) {
        $validator = Validator::make($request->all(),
                ['name'=>"required",
                 'subject'=>'required',
                 'mark'=>'required']);
        if ($validator->fails()) {
            return ["status"=>false,
                    "message"=>$validator->errors()->first()];
       }
       $data= $validator->valid();
        return ["status"=>true,
                "data"=>$data];
   }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
                $validatedData=$this->validate_input($request);
                if(!$validatedData['status'])
                {
                    return response()->json($validatedData);
                }
                $data=$validatedData['data'];
                $student=Student::where(["name"=>$data['name'],
                                "subject"=>$data['subject']])->first();
                if($student)
                {
                    $student->update(["mark"=>$data['mark']]);
                }else{
                    $student=Student::create($data);
                }
                return response()->json(["status"=>true,
                                        "message"=>"Inserted Successfully",
                                        "data"=>$student]);
        }catch(\Exception $e)
        {
            return response()->json(["status"=>false,
                                        "message"=>$e->getMessage()]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return response()->json(["status"=>true,
                                 "data"=>$student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        try{
                $validatedData=$this->validate_input($request);
                if(!$validatedData['status'])
                {
                    return response()->json($validatedData);
                }
                $data=$validatedData['data'];
                if(Student::where(["name"=>$data['name'],"subject"=>$data['subject']])->where('id','!=',$student->id)->exists())
                {
                    return response()->json(["status"=>false,
                                        "message"=>"Duplication exists"]);
                }
                $student->update($data);
                return response()->json(["status"=>true,
                                        "message"=>"Updated Successfully",
                                        "data"=>$student]);
        }catch(\Exception $e)
        {
            return response()->json(["status"=>false,
                                        "message"=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try{

            $student->delete();
            return response()->json(["status"=>true,
                                     "message"=>"Deleted Successfully"]);
        }catch(\Exception $e)
        {
            return response()->json(["status"=>false,
                                     "message"=>$e->getMessage()]);
        }
    }
}
