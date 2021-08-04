<?php

namespace App\Http\Controllers;

use App\Quote;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuoteController extends Controller
{
    //public function getRandomQuote(){
    //    $quotes = json_decode(Quote::all());
    //    $size = count($quotes);
    //    $randomId = rand(1, $size);
    //    $quote = Quote::where('id', '=', "$randomId")->get();
    //    return $quote;
   // }

    public function addQuote(){
        Quote::create(request()->all());
        return 'Quote added successfully!';
    }

    public function destroy($id){
        Quote::find($id)->delete();
        return 'Quote deleted successfully!';
    }

    public function update($id){
        $quote = Quote::find($id);
        $quote->quote = request('quote');
        $quote->author = request('author');
        $quote->source = request('source');

        $quote->save();

        return 'Quote edited successfully!';
    }

    public function getAllQuotes(){
        $quotes = Quote::all();
        return $quotes;
    }

    public function getQuote($id){
        $quote = Quote::find($id);

        return $quote;
    }
}
