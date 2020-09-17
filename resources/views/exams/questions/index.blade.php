@extends('layouts.exam')

@section('title')
    {{$exam->title}} Exam
@endsection

@section('content')
    <h1 class="title my-5">{{$exam->title}} Exam <span class="add"><a data-toggle="modal"
                                                                      data-target="#add-question-modal"
                                                                      href="javascript:void(0)"><i
                    class="fa fa-plus-circle text-success"></i></a></span></h1>
    <div class="row justify-content-center">
        @foreach($categories as $category)
            <div class="col-sm-4">
                <h3 class="mb-5 text-danger text-sm-left text-center">{{ucfirst($category)}} Questions</h3>
                <ul class="pl-sm-0 pl-5" id="{{$category}}-questions" style="list-style-type: decimal-leading-zero">
                    @if(count($questions[$category]))
                        @foreach($questions[$category] as $question)
                            <li class="question mb-4">
                                <p class="description w-75">{{$question->description}}</p>
                                <ul class="options" style="list-style: none;">
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                   id="option-a"
                                                   disabled>
                                            <label class="form-check-label" for="option-a">
                                                {{$question->option_a}}
                                            </label>
                                        </div>
                                    </li>
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                   id="option-c"
                                                   disabled>
                                            <label class="form-check-label" for="option-c">
                                                {{$question->option_b}}
                                            </label>
                                        </div>
                                    </li>
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                   id="option-c"
                                                   disabled>
                                            <label class="form-check-label" for="option-c">
                                                {{$question->option_c}}
                                            </label>
                                        </div>
                                    </li>
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                   id="option-d"
                                                   disabled>
                                            <label class="form-check-label" for="option-d">
                                                {{$question->option_d}}
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    @else
                        <li>No questions in this category</li>
                    @endif
                </ul>
            </div>
        @endforeach
    </div>

    {{--Add Question Modal--}}
    <div class="modal fade" id="add-question-modal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-question" method="POST" action="{{route('exams.store')}}">
                        <div class="alert alert-danger d-none">Please fill in all details</div>
                        @csrf
                        @include('includes.form_error')
                        <div class="form-group">
                            <label for="description">Question</label>
                            <textarea id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <select class="custom-select" id="category">
                                <option selected>Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category}}">{{ucfirst($category)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="option-a">Option A</label>
                            <input id="option-a" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="option-b">Option B</label>
                            <input id="option-b" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="option-c">Option C</label>
                            <input id="option-c" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="option-d">Option D</label>
                            <input id="option-d" type="text" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button onclick="addExamQuestion(this)" type="button" class="btn btn-success col-4">Add
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        'use strict';

        const addExamQuestion = (btn) => {
            document.querySelector('#add-question .alert-danger').classList.add('d-none');
            btn.setAttribute('disabled', 'disabled');

            const description = document.querySelector('form#add-question #description').value;
            const category = document.querySelector('form#add-question #category').value;
            const option_a = document.querySelector('form#add-question #option-a').value;
            const option_b = document.querySelector('form#add-question #option-b').value;
            const option_c = document.querySelector('form#add-question #option-c').value;
            const option_d = document.querySelector('form#add-question #option-d').value;
            const data = {
                description: description,
                category: category,
                option_a: option_a,
                option_b: option_b,
                option_c: option_c,
                option_d: option_d,
            }

            axios.post('/api/exams/{{$exam->id}}/questions', data, {
                responseType: 'json',
                headers: {
                    'Accept': 'application/json'
                }
            })
                .then(resp => {
                    const question_html = `
                        <li class="question mb-4">
                                <p class="description w-75">${description}</p>
                                <ul class="options" style="list-style: none;">
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="option-a"
                                                   disabled>
                                            <label class="form-check-label" for="option-a">
                                                ${option_a}
                                            </label>
                                        </div>
                                    </li>
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="option-c"
                                                   disabled>
                                            <label class="form-check-label" for="option-c">
                        ${option_b}
                                            </label>
                                        </div>
                                    </li>
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="option-c"
                                                   disabled>
                                            <label class="form-check-label" for="option-c">
                        ${option_c}
                                            </label>
                                        </div>
                                    </li>
                                    <li class="option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="option-d"
                                                   disabled>
                                            <label class="form-check-label" for="option-d">
                        ${option_d}
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            `;
                    document.querySelector(`#${category}-questions`).innerHTML += question_html;
                    $('#add-question-modal').modal('hide');
                })
                .catch(err => {
                    console.log(err.message)
                    document.querySelector('#add-question .alert-danger').classList.remove('d-none');
                    btn.removeAttribute('disabled');
                })
                .finally(() => {
                    btn.removeAttribute('disabled');
                })
        }

    </script>
@endsection
