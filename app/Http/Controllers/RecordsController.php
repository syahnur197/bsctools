<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Record;

class RecordsController extends Controller
{
    public function index()
    {
        return response()->json(Record::with('owner')->get());
    }

    public function store(Request $request, Response $response)
    {
        $record = new Record();
        $record->ahc_id = auth()->user()->id;
        $record->save();
    }

    public function show(Request $request, Response $response, $record)
    {
        return view('records.view', ['record_id' => $record]);
    }

    public function get(Request $request, Response $response, $record)
    {
        $record = Record::with(['owner', 'speakers'])->find($record);
        return response()->json($record);
    }

    public function report(Request $request, Response $response, $record) {
        $record = Record::with(['owner', 'speakers', 'words'])->find($record);
        return view('records.report', ['record' => $record]);
    }
}
