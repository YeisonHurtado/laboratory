
            @foreach($products as $product)
                <tr class="item">
                    <td>{{$product->PRODUCT_CODE}}</td>
                    <td>{{$product->PRODUCT_NAME}}</td>
                    <td><i class="fa fa-dollar-sign"></i> {{$product->PRODUCT_VAL}}</td>
                </tr>
            @endforeach