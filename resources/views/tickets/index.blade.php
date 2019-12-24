@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>tickets</h3></div>
                                   
                        <div class="panel-body">
                        <!-- @foreach ($tickets as $ticket)
                            <li style="list-style-type:disc">
                                <a href="{{ route('tickets.show', $ticket->id ) }}"><b>{{ $ticket->title }}</b><br>
                                    <p class="teaser">
                                       {{  $ticket->body }} 
                                    </p>
                                </a>
                            </li>
                            @endforeach -->
                            <table class="table table-bordered">
                                <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Action</th>
                                <th>Status</th>
                                </tr>
                                {{$tickets}}
                                @if($tickets->isEmpty())
                                <tr>
                                    <td colspan="7" style="text-align:center">No Tickets</td>
                                </tr>
                                @else
                                @foreach ($tickets as $key => $ticket)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ hideEmail($ticket->email) }}</td>
                                    <td>{{ hidecontact($ticket->contact) }}</td>
                                    <td>
                                    <a class="btn btn-info" href="{{ route('tickets.show',$ticket->id) }}">View</a>
                                    </td>
                                    <td>{{$ticket->status }}</td>
                                </tr>
                                @endforeach
                                @endif
                                </table>

                        </div>
                   
                    </div>
                    <div class="text-center">
                        {!! $tickets->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection