<?php

namespace App\Http\Controllers;

use App\Quote;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuoteController extends Controller
{
    public function getRandomQuote(){
        $quotes = Quote::pluck('id');
        $randomId = rand(0, count($quotes)-1);
        $quote = Quote::find($quotes[$randomId]);
        return $quote;

    }

    public function addQuote(){
        Quote::create(request()->all());
        return Redirect::route('manage');;
    }

    public function destroy($id){
        Quote::find($id)->delete();
        return Redirect::route('manage');
    }

    public function update($id){
        $quote = Quote::find($id);
        $quote->quote = request('quote');
        $quote->author = request('author');
        $quote->source = request('source');

        $quote->save();

        return Redirect::route('manage');
    }

    public function getLeaderboard(){
        $quotes = DB::table('quote')
        ->select('quote.id','quote.quote','quote.author','quote.source',DB::raw("count(score.quote_id) AS scores"))
        ->join('score','quote.id','=','score.quote_id')
        ->groupBy('quote.id')
        ->get();

        return view('leaderboard')->with('quotes',$quotes);
    }

    public function getQuote($id){
        $quote = Quote::find($id);

        return $quote;
    }

    public function addQuotePage(){
        return view('addquote');
    }

    public function manageQuotes(){
        $quotes = Quote::all();
        
        return view('manage')->with('quotes',$quotes);
    }

    public function editQuote($id){
        $quote = Quote::find($id);
        return view('editquote')->with('quote',$quote);
    }
}
