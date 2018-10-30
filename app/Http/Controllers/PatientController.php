<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $patients = Patient::whereNull('EST_COD')->orWhere('EST_COD','!=',$code)->get();

        return view('patient.tables.patients', compact('patients'));
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
        $patient = new Patient();

        $validate = Validator::make($request->all(),[
            'nhc'=>'required',
            'name_patient'=>'required'
        ]);

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        $patient->NUM_PACIENTE = $request->get('nhc');
        $patient->NOMBRE = $request->get('name_patient');
        $patient->EST_COD = $request->get('code_student');
        $result = $patient->save();

        if ($result){
            return response()->json(['save'=>'true']);
        } else {
            return response()->json(['save'=>'false']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($numhc)
    {
        $patient = Patient::find($numhc);
        return response()->json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $numhc)
    {
        $patient = Patient::find($numhc);
        $patient->EST_COD = $request->get('student_code');
        $result = $patient->save();

        if ($result){
            return response()->json(['update'=>'true']);
        } else {
            return response()->json(['update'=>'false']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
