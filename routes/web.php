<?php

use App\Record;
use App\Speaker;
use App\Word;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// record

Route::get('/record', function() {
    // return response()->json(Record::all());
    return response()->json(Record::with('owner')->get());
});

Route::post('/record', function(Request $request, Response $response) {
    $record = new Record();
    $record->ahc_id = auth()->user()->id;
    $record->save();
});

Route::get('/record/{record}', function(Request $request, Response $response, $record) {
    if ($request->ajax()) {
        $record = Record::with(['owner', 'speakers'])->find($record);
        return response()->json($record);
    }
    return view('records.view', ['record_id' => $record]);
});

Route::get('/record/report/{record}', function(Request $request, Response $response, $record) {
    $record = Record::with(['owner', 'speakers', 'words'])->find($record);
    return view('records.report', ['record' => $record]);
});

// Speaker

Route::get('/speaker/{speaker}', function (Request $request, Response $response, $speaker) {
    $speaker = Speaker::find($speaker);
    return view('speakers.view', ['speaker' => $speaker]);
});

Route::post('/speaker', function (Request $request, Response $response) {
    $speaker = $request->validate([
        'name' => 'required|max:255',
        'record_id' => 'required|integer'
    ]);
    Speaker::create($speaker);
});

Route::delete('/speaker/{speaker}', function (Request $request, Response $response, Speaker $speaker) {
    $speaker->delete();
});

// words
Route::post('/word', function (Request $request, Response $response) {
    $words = $request->input('words');
    $speaker = $request->input('speaker');

    foreach($words as $word) {
        $word = (object) $word;
        if (isset($word->id)) {
            $word_data = Word::find($word->id);
            $word_data->count = $word->count;
            $word_data->save();
        } else {
            Word::create(['speaker_id' => $speaker, 'word' => $word->word, 'count' => $word->count]);
        }
    }
    return response()->json($words);
});

Route::get('/word/{speaker}', function (Request $request, Response $response, $speaker) {
    $speaker = Speaker::with('words')->find($speaker);
    $words = $speaker->words;
    return response()->json($words);
});
