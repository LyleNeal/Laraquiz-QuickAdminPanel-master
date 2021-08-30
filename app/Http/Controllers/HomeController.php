<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\User;
use App\TestAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::count();
        $users = User::select('role_id')
                ->where('role_id', '=', NULL)
                ->orWhere('role_id', '=', 2)
                ->count();
        $quizzes = Test::count();
        $average = Test::max('result');

        Carbon::setWeekStartsAt(Carbon::MONDAY);

        $player = TestAnswer::selectRaw('users.name NAME, sum(test_answers.correct) EXP')
                ->join('users', 'users.id', '=', 'test_answers.user_id')
                ->where('users.id', '!=', 1)
                ->whereBetween('test_answers.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
                ->groupBy('users.id')
                ->orderBy('EXP', 'DESC')
                ->get();
        
        return view('home', compact('questions', 'users', 'quizzes', 'average', 'player'));
    }
}
