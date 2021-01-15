@if (Auth::user()->image)
    <div class="container-avatar">
        {{--<img src="{{ url('usuario/avatar/'.Auth::user()->image) }}"/> --}}
        <img src="{{ route('user.avatar', array('file_name' => Auth::user()->image)) }}" class="avatar"/>
    </div>
@endif
