<div class="modal fade" id="modalLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            @include('forms.laboratory_form')
        </div>
    </div>
    @section("modalDelete_header", "Eliminar laboratorio")
    @section("content_modalDelete")
    @endsection
</div>
