<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Speaker;

class SpeakersController extends Controller
{
    public function show(Request $request, Response $response, $speaker)
    {
        $speaker = Speaker::find($speaker);
        return view('speakers.view', ['speaker' => $speaker]);
    }

    public function store(Request $request, Response $response)
    {
        $speaker = $request->validate([
            'name' => 'required|max:255',
            'record_id' => 'required|integer'
        ]);
        Speaker::create($speaker);
    }

    public function destroy(Request $request, Response $response, Speaker $speaker)
    {
        $speaker->delete();
    }
}
