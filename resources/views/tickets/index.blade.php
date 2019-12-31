@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Tickets</h3></div>
                                   
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tr>
                                <th>No</th>
                                <th>Created Date</th>
                                <th>Title</th>
                                <th>Action</th>
                                <th>Status</th>
                                </tr>
                                @if($tickets->isEmpty())
                                <tr>
                                    <td colspan="7" style="text-align:center">No Tickets</td>
                                </tr>
                                @else
                                @foreach ($tickets as $key => $ticket)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>
                                    @can('ticket edit')
                                    @role('customer')
                                    @if($ticket->status==1)
                                    <a class="btn btn-info" href="{{ route('tickets.edit',$ticket->id) }}">Edit</a>
                                    @endif
                                    @endrole
                                    @role('tech')
                                    @if($ticket->status==0)
                                    <a class="btn btn-info" href="{{ route('tickets.edit',$ticket->id) }}">Edit</a>
                                    @endif
                                    @endrole
                                    
                                    @endcan
                                    <a class="btn btn-info" href="{{ route('tickets.show',$ticket->id) }}">View</a>
                                    </td>
                                    <td>@if($ticket->status==2)Closed @else Pending @endif</td>
                                </tr>
                                @endforeach
                                @endif
                                </table>
                        </div>
                    </div>
                    <div class="text-center">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection