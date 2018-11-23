@extends("layout.layout")
@section("title_page","Menú principal")
@section("content_page")
<div class="row-menu">
    <div class="menu" data-toggle="modal" data-target="#miModal">
      <img src="{{asset('images/receipt.png')}}" alt="">
      <span>ORDEN DE PAGO</span>
    </div>
    <div class="menu"  data-toggle="modal" data-target="#entryModal">
      <img src="{{asset('images/trabajo.svg')}}" alt="">
      <span>AUTORIZACIÓN INGRESO TRABAJO LABORATORIO</span>
    </div>
    <div class="menu">
      <img src="{{asset('images/tiempo.png')}}" alt="">
      <span>RECEPCIÓN DE TRABAJOS ENVIADOS POR EXT</span>
    </div>
    <div class="menu" data-toggle="modal" data-target="#sendModal">
        <span>Orden de despacho</span>
    </div>
</div>
<div class="row-menu">
  <div class="menu" data-toggle="modal" data-target="#miModalProduct">
    <img src="{{asset('images/producto.svg')}}" alt="">
    <span>PRODUCTOS</span>
  </div>
  <div class="menu" data-toggle="modal" data-target="#modalLab">
    <img src="{{asset('images/lab.png')}}" alt="">
    <span>LABORATORIOS</span>
  </div>
  <div class="menu" data-toggle="modal" data-target="#modalEmp">
    <img src="{{asset('images/empleado.png')}}" alt="">
    <span>EMPLEADOS</span>
  </div>
</div>
@include("modal.receipt")
@include("modal.entry_work")
@include("modal.send")
@include("modal.products")
@include("modal.listproducts")
@include("modal.laboratories")
@include("modal.listlaboratories")
@include("modal.employees")
@include("deletemodals.productDelete")
@include("deletemodals.laboratoryDelete")
@include("patient.patients_student")
@include("patient.allpatients")
@include("pending.payments.modal")
@endsection
