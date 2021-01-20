<div class="card pub_image">

    <div class="card-header">

        @if($image->user->image)
            <div class="container-avatar">
                <img src="{{ route('user.avatar', array('file_name' => $image->user->image)) }}" class="avatar"/>
            </div>
        @endif

        <span class="data-user">
            <a href="{{ route('user.profile', array('user_id' => $image->user->id)) }}">
                {{ $image->user->name  . ' ' .$image->user->surname }}
                <span class="color-gray">{{ ' | @' .$image->user->nick}}</span>
            </a>
        </span>

        <span class="datetime">{{FormatTime::LongTimeFilter($image->created_at)}}</span>

    </div>

    <div class="card-body">

        <div class="image-container">
            <a href="{{ route('image.detail', array('id' => $image->id)) }}">
                <img  src="{{ route('image.traer', array('file_name' => $image->image_path)) }}" >
            </a>
        </div>

        <div class="description">
            <span class="color-gray">{{'@'.$image->user->nick. ': '}}</span>
            <span>{{$image->description}}</span>

            <div class="likes">
                <span class="color-gray">{{ count($image->likes) }}</span>

                {{--COMPROBAR SI EL USUARIO LOGUEADO LE DIO LIKE A LA PUBLICACION--}}
                <?php $user_like = false; ?>

                @foreach ($image->likes as $like)
                    @if ($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                    @endif
                @endforeach

                @if ($user_like)
                    <img class="btn-dislike"src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}">
                @else
                    <img class="btn-like"src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" >
                @endif
            </div>
        </div>

        <div data-toggle="modal" data-target="#mostrar{{$image->id}}">
            <a href="#" class="btn btn-outline-dark btn-comments">Comentarios ({{count($image->comments)}})</a>
        </div>

    </div>
</div>
