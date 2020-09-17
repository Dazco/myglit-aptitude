@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li><strong>{{$error}}</strong></li>
            @endforeach
        </ul>
    </div>
@endif