<option value="">-- Escoge un producto --</option>
@foreach($products as $product)
    <option value="{{$product->PRODUCT_CODE}}">{{$product->PRODUCT_CODE}}   -   {{$product->PRODUCT_NAME}}</option>
@endforeach