@extends('layouts.exam')

@section('title')
    Edit Exam
@endsection

@section('content')
    <h1 class="title my-5">Edit Exam</h1>

    <form class="col-md-6" method="POST" action="{{route('exams.update', $exam->id)}}">
        @csrf
        @include('includes.form_error')
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="exam-title">Exam Title</label>
            <input id="exam-title" name="title" type="text" class="form-control" value="{{old('title', $exam->title)}}">
        </div>
        <button type="submit" class="btn btn-danger col-4">Update</button>
    </form>
@endsection
