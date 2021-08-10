<?php

namespace App\Http\Controllers;

use App\Quote;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuoteController extends Controller
{
    public function getRandomQuote(){
        $quotes = json_decode(Quote::all());
        $size = count($quotes);
        $randomId = rand(1, $size);
        $quote = Quote::where('id', '=', "$randomId")->get();
        return $quote;

    }

    public function addQuote(){
        Quote::create(request()->all());
        return 'Quote added successfully!';
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

    public function getAllQuotes(){
        $quotes = Quote::all();
        return $quotes;
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
