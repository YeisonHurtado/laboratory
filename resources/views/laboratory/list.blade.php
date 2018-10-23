@foreach($laboratories as $laboratory)
    <tr class="item_lab">
        <td hidden><input type="text" value="{{$laboratory->ID}}"></td>
        <td>{{$laboratory->NAME}}</td>
        <td>{{$laboratory->ADDRESS}}</td>
        <td>{{$laboratory->TEL}}</td>
        <td>{{$laboratory->EMAIL}}</td>
    </tr>
@endforeach