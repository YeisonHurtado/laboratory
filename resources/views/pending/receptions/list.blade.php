
    @foreach($entries as $entry)
        <tr>
            <td>{{date("d/m/Y", strtotime($entry->FECHA_INGRESO))}}</td>
            <td>{{$entry->ID_ORDEN}}</td>
            <td>{{$entry->IDFACTURA}}</td>
        @if($entry->METODO_PAGO == 1)
                <td>Crédito</td>
            @elseif($entry->METODO_PAGO == 2)
                <td>Único pago</td>
            @endif
            <td>{{$entry->EST_COD}}</td>
            <td>{{ucwords($entry->NOMBRE_EST)}}</td>
            <td>{{$entry->NUM_PACIENTE}}</td>
            <td>{{$entry->NOMBRE}}</td>
            <td>{{$entry->NAME}}</td>
            <td>{{$entry->PREESCRIPCION}}</td>
            <td>
                <button type="button" data-id_recp="{{$entry->INGRESO_ID}}" class="btn btn-success btn-sm w-100 send_work" title="Enviar trabajo del estudiante {{$entry->NOMBRE_EST}}"><i class="fas fa-share-square"></i> Despachar</button>
            </td>
            <td>
                <button type="button" data-id_recp="{{$entry->INGRESO_ID}}" class="btn btn-danger btn-sm w-100 deny_work" title="No despachar trabajo del estudiante {{$entry->NOMBRE_EST}}"><i class="fas fa-times"></i> No despachar</button>
            </td>
        </tr>
    @endforeach
    @foreach($entries2 as $entry)
        <tr>
            <td>{{date("d/m/Y", strtotime($entry->FECHA_INGRESO))}}</td>
            <td>{{$entry->ID_ORDEN}}</td>Despachar
            <td>{{$entry->ID}}</td>
        @if($entry->METODO_PAGO == 1)
                <td>Crédito</td>
            @elseif($entry->METODO_PAGO == 2)
                <td>Único pago</td>
            @endif
            <td>{{$entry->EST_COD}}</td>
            <td>{{ucwords($entry->NOMBRE_EST)}}</td>
            <td>{{$entry->NUM_PACIENTE}}</td>
            <td>{{$entry->NOMBRE}}</td>
            <td>{{$entry->NAME}}</td>
            <td>{{$entry->PREESCRIPCION}}</td>
            <td>
                <button type="button" data-id_recp="{{$entry->INGRESO_ID}}" class="btn btn-success btn-sm w-100 send_work" title="Enviar trabajo del estudiante {{$entry->NOMBRE_EST}}"><i class="fas fa-share-square"></i> Despachar</button>
            </td>
            <td>
                <button type="button" data-id_recp="{{$entry->INGRESO_ID}}" class="btn btn-danger btn-sm w-100 deny_work" title="No despachar trabajo del estudiante {{$entry->NOMBRE_EST}}"><i class="fas fa-times"></i> No despachar</button>
            </td>
        </tr>
    @endforeach
