@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3> -->
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store'], 'onsubmit' => "return confirm('Do you really want to submit the form?')"]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.quiz')
        </div>
        <?php //dd($questions) ?>
    @if(count($questions) > 0)
        <div class="panel-body">
        <?php $i = 1; ?>
        @foreach($questions as $question)
            <div class="row {{ $i > 1 ? 'hidden' : '' }}" id="question-{{ $i }}">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong style="font-size:30px">Question {{ $i }}.<br><br>{!! nl2br($question->question_text) !!}</strong>

                        @if ($question->code_snippet != '')
                            <div class="code_snippet">{!! $question->code_snippet !!}</div>
                        @endif

                        <br>
                        <input
                            type="hidden"
                            name="questions[{{ $i }}]"
                            value="{{ $question->id }}">
                    @foreach($question->options as $option)
                        <br>
                        <label style="font-size:30px" class="radio-inline">
                            <input
                                style="font-size:30px"
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option['id'] }}">
                            {{ $option["option"] }}
                        </label>
                    @endforeach
                    </div>
                </div>
            </div>
        <?php $i++; ?>
        @endforeach
        </div>
    @endif
    </div>

    
    <button type="button" class="btn btn-success hidden" id="pagingPrevious">Previous</button>
    {!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger hidden float-right', 'id' => 'buttonSubmit'], ) !!}
    <button type="button" class="btn float-right btn-warning" id="pagingNext">Next</button>
    {!! Form::close() !!}

    
 
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });

        $(document).ready(function() {
            let page = 1
            let limit = {{count($questions)}}
            $("#pagingNext").click(function (e) {
                $(`#question-${page}`).addClass("hidden")  
                page += 1
                $(`#question-${page}`).removeClass("hidden")
                if (page == limit) {
                    $(`#pagingNext`).addClass("hidden")
                    $(`#buttonSubmit`).removeClass("hidden")
                }
                if (page != 1) {
                    $(`#pagingPrevious`).removeClass("hidden")
                }
            });
            $("#pagingPrevious").click(function (e) {
                $(`#question-${page}`).addClass("hidden")  
                page -= 1
                $(`#question-${page}`).removeClass("hidden")
                if (page == 1) {
                    $(`#pagingPrevious`).addClass("hidden")
                }
                if (page < limit) {
                    $(`#pagingNext`).removeClass("hidden")
                    $(`#buttonSubmit`).addClass("hidden")
                }
            });
        })
    </script>

@stop
