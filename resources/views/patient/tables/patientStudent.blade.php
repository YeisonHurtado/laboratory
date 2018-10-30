@foreach($patients as $patient)
    <tr class="patient_item">
        <td>{{$patient->NUM_PACIENTE}}</td>
        <td>{{$patient->NOMBRE}}</td>
    </tr>
@endforeach
