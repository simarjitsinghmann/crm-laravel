@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>tickets</h3></div>
                    <div class="panel-heading">Page {{ $tickets->currentPage() }} of {{ $tickets->lastPage() }}</div>
                    @foreach ($tickets as $ticket)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('tickets.show', $ticket->id ) }}"><b>{{ $ticket->title }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($ticket->body, 100) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $tickets->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection