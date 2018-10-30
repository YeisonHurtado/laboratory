@foreach($patients as $patient)
    <tr class="patients_items">
        <td>{{$patient->NUM_PACIENTE}}</td>
        <td>{{$patient->NOMBRE}}</td>
    </tr>
@endforeach
