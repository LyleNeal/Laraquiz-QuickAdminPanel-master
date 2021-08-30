@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel">
                <div class="panel-heading">Selamat Datang di Kuis Sambung Ayat.</div>

                <div class="panel-body">
                    <div class="row">
                        <!-- <div class="col-md-3 text-center">
                            <h1>{{ $questions }}</h1>
                            Pertanyaan 
                        </div>-->
                        <div class="col-md-3 text-center">
                            <h1>{{ $users }}</h1>
                            Pemain Teregistrasi
                        </div>
                        <div class="col-md-3 text-center">
                            <h1>{{ $quizzes }}</h1>
                            quizzes taken
                        </div>
                        <!-- <div class="col-md-3 text-center">
                            <h1>{{ number_format($average*10) }}</h1>
                            average score
                        </div> -->
                    </div>
                </div>
            </div>
            <a href="{{ route('tests.index') }}" class="btn btn-success">Take a new quiz!</a>
            <br>
            <br>
            <br>
            <h1>This Week Leaderboard</h1>
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h3>Name</h3>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3>EXP</h3>
                        </div>
                    </div>
                </div>
                @foreach ($player as $p)
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h4> {{ $p["NAME"] }}</h4>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4> {{ $p["EXP"] }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection