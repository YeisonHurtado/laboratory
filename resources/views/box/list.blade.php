<option value="">-- Selecciona una caja --</option>
@foreach($boxes as $box)
    <option value="{{$box->ID}}" {{$box->PACIENTE_ID != NULL ? 'disabled' : ''}}>{{$box->DESCRIPCION}}</option>
@endforeach
