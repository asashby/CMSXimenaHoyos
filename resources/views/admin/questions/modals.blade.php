<div class="modal fade" id="answerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva respuesta </h5>
                <button type="button" class="close cancel-answer" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.questions.partials.form_modal')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel-answer" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary add-answer">Guardar</button>
            </div>
        </div>
    </div>
</div>

{{---- LISTAR RESPUESTAS POR PREGUNTA  -----}}
<div class="modal fade" id="answerListModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Series y Repeticiones asignadas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="data-answers col-md-12">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

