<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Word;
use App\Speaker;

class WordsController extends Controller
{
    public function store(Request $request, Response $response)
    {
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
    }

    public function show(Request $request, Response $response, $speaker)
    {
        $speaker = Speaker::with('words')->find($speaker);
        $words = $speaker->words;
        return response()->json($words);
    }
}
