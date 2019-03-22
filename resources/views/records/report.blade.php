@extends('layouts.app')

@section('content')
<div class="row justify-content-center my-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Report</div>
            <div class="card-body">
                <p>Report for AHC for Meeting on {{$record->created_at}} by {{$record->owner->name}}</p>
                @foreach($record->speakers as $speaker)
                    <strong>Name: </strong> {{$speaker->name}}
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>Word</th>
                                <th>Count</th>
                            </thead>
                            @foreach ($speaker->words as $word)
                                <tr>
                                    <td>{{$word->word}}</td>
                                    <td>{{$word->count}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
