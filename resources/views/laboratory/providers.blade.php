<option value="">-- Seleccione el laboratorio --</option>
@foreach($providers as $laboratory)
    <option value="{{$laboratory->ID}}">{{$laboratory->NAME}}</option>
@endforeach
