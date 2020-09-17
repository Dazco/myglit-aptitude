@extends('layouts.exam')

@section('title')
    All Exams
@endsection

@section('styles')
    <style>
        .exam {
            width: 300px;
            max-height: 300px;
            padding: 1% 3%;
            border-radius: 20px;
            position: relative;
        }

        .exam > .edit {
            position: absolute;
            bottom: 10px;
            right: 5%;
            border: 2px solid #ffffff;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
    <section>
        <h1 class="title my-5">Exams <span class="add"><a href="{{route('exams.create')}}"><i
                        class="fa fa-plus-circle text-success"></i></a></span></h1>

        @if(count($exams))
            <div class="row justify-content-md-between justify-content-center">
                @foreach($exams as $exam)
                    <div class="bg-success text-white exam mr-2 mb-2">
                        <form id="delete-{{$exam->id}}" action="{{route('exams.destroy', $exam->id)}}" method="POST" class="float-right">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <a onclick="confirm('Do you really want to delete this exam and all of it\'s questions? This cannot be reversed.')?document.querySelector('#delete-{{$exam->id}}').submit():false;"
                               type="submit" href="#"><i class="fa fa-trash-alt fa-1x text-danger"></i></a>
                        </form>
                        <h3 class="exam-title"><a class="text-white" href="{{route('exams.show', $exam->id)}}">{{$exam->title}}</a></h3>

                        <small>30 questions</small>
                        <a href="{{route('exams.edit', $exam->id)}}" class="edit"><i class="fa fa-pen"></i></a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-danger">Add an exam to begin.</p>
        @endif
    </section>
@endsection
