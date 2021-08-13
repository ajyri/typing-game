<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Score;

class ScoreController extends Controller
{

    //If the user is logged in save his score to the database.

    public function saveScore(Request $request){
        if(Auth::check()){
        
        $userid = Auth::user()->id;
        $data = $request;
        $wpm = $data->wpm;
        $acc = $data->acc;
        $quote = $data->quote_id;

        $score = new Score;

        $score->quote_id = $quote;
        $score->wpm = $wpm;
        $score->acc = $acc;
        $score->user_id = $userid;
        
        $score->save();

        }
    }

    //Retrieve scores for a specific quote and return them.

    public function viewScore(){
        $id = request('id');

        $scores = DB::table('score')
        ->select('score.quote_id','score.wpm','score.acc','score.user_id','users.name')
        ->join('users','score.user_id','=','users.id')
        ->where('score.quote_id', '=', "$id")
        ->orderBy('score.wpm', 'desc','score.acc', 'desc')
        ->get();

        return view('viewscore')->with('scores',$scores);
    }
}
