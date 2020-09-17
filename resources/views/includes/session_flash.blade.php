@if(Session::has('alert-success'))
    <div class="alert alert-success"><p><strong>{{Session::get('alert-success')}}</strong></p></div>
@elseif(Session::has('alert-danger'))
    <div class="alert alert-danger"><p><strong>{{Session::get('alert-danger')}}</strong></p></div>
@endif