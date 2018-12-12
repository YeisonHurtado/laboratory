@foreach($entries as $entry)
    <tr>
        <td class="idOrden">{{$entry->IDORDEN}}</td>
        <td>{{$entry->EST_COD}}</td>
        <td>{{$entry->NOMBRE_EST}}</td>
        <td>{{$entry->NUM_PACIENTE}}</td>
        <td>{{$entry->NOMBRE}}</td>
    </tr>
@endforeach
