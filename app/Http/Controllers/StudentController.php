<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function patients($code)
    {
        $patients = Student::find($code)->patient;

        return view('patient.tables.patientStudent', compact('patients'));
    }
    
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $countStudents = Student::where('EST_COD',$request->get('code_student'))->count();
        $code = $request->get('code_student');
        $validate = Validator::make($request->all(),[
            'code_student'=>'required|min:9|max:9',
            'name_student'=>'required|max:50',
            'email'=>'required|email|max:50',
            'telefono'=>'required|max:11',
            'semestre'=>'required'
        ]);

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        if ($countStudents == 1) {
            return $this->update($request, $code);
        }

        $student = new Student();
        $validate = Validator::make($request->all(),[
            'code_student'=>'required|min:9|max:9',
            'name_student'=>'required|max:50',
            'email'=>'required|email|max:50',
            'telefono'=>'required|max:11',
            'semestre'=>'required'
        ]);

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        $student->EST_COD = $request->get('code_student');
        $student->NOMBRE_EST = $request->get('name_student');
        $student->CORREO = $request->get('email');
        $student->TEL_CEL = $request->get('telefono');
        $student->SEMESTRE = $request->get('semestre');
        $result = $student->save();

        if ($result){
            return response()->json(['save'=>'true']);
        } else {
            return response()->json(['save'=>'false']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $student = Student::find($code);

        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        return response()->json(['update'=>'true']);
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
}
