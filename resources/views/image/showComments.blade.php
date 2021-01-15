<!--Si la imagen tiene comentarios-->
<?php if($image->comments->count() > 0){  ?>

    <div class="modal fade" id="mostrar{{$image->id}}">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h3>Comentarios de la publicacion</h3>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @foreach ($image->comments as $comment)

                        <div class="comment">
                            <span><strong>{{'@'.$comment->user->nick. ': '}}</strong></span>
                            <span class="comentario-modal">{{$comment->content}}</span>
                            <div class="date-modal"> ({{FormatTime::LongTimeFilter($comment->created_at)}})

                                @if( Auth::check() && ($comment->user_id == Auth::user()->id  || $comment->image->user_id == Auth::user()->id) )
                                    <a  href="{{ route('comment.delete', array('id' => $comment->id)) }}" class="btn btn-sm btn-outline-danger float-right">
                                        Eliminar</a>
                                @endif

                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

<?php } else{ ?> <!--Si la imagen no tiene comentarios-->
    <div class="modal fade" id="mostrar{{$image->id}}">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h3>No hay comentarios para mostrar</h3>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
