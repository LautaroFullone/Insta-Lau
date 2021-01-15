<div class="modal fade" id="confirmar">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h3>¿Estas seguro?</h3>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Una vez eliminada la imagen no hay manera de volver a recuperarla. </p>
            </div>
            <div class="modal-footer">
                <a href="" type="button" class="btn btn-outline-danger">Cancelar</a>
                <a href="{{ route('image.delete', array('image_id' => $image->id)) }}" type="button" class="btn btn-outline-success">Confirmar</a>
            </div>
        </div>
    </div>
</div>
