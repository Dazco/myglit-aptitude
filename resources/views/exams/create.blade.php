@extends('layouts.exam')

@section('title')
    Create Exams
@endsection

@section('content')
    <h1 class="title my-5">Add Exam</h1>

    <form class="col-md-6" method="POST" action="{{route('exams.store')}}">
        @csrf
        @include('includes.form_error')
        <div class="form-group">
            <label for="exam-title">Exam Title</label>
            <input id="exam-title" name="title" type="text" class="form-control">
        </div>
        <button type="submit" class="btn btn-success col-4">Submit</button>
    </form>
@endsection
