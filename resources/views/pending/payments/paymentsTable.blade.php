@foreach($orderPayments as $payment)
    <tr class="item-payment">
        <td hidden>{{$payment->IDORDEN}}</td>
        <td>{{$payment->IDFACTURA}}</td>
        <td>{{$payment->EST_COD}}</td>
        <td>{{$payment->NOMBRE_EST}}</td>
        <td>{{$payment->HCLINICA}}</td>
        <td>{{$payment->NOMBRE}}</td>
        <td>{{$payment->CONSIGNADO}}</td>
    </tr>
@endforeach
