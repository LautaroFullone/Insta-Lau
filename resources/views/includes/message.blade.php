
@if(session('message'))
<div class="form-group row">
    <div class="mx-auto">
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    </div>
</div>

@endif
