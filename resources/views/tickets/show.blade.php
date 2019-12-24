@extends('layouts.app')

@section('title', '| View ticket')

@section('content')

<div class="container">
    <div class="grid__item">
    <h1 class="d-inline">Ticket ID :- {{ $ticket->id }}</h1><a href="{{ route('tickets.index') }}" class="btn btn-primary d-inline">Back</a>
    </div>
    <hr>

    <h2>Ticket Title :- {{$ticket->title}}</h2>
    <table class="table table-bordered"> 
        
        <tr>
            <th>Ticket Title</th>
            <td>{{ $ticket->title }}</td>
        </tr>
        <tr>
            <th>Email Id</th>
            <td>{{ hideEmail($ticket->email) }}</td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td>{{ hidecontact($ticket->contact) }}</td>
        </tr>
        <tr>
            <th>Ticket Description</th>
            <td>{{$ticket->body }}</td>
        </tr>
        <tr>
            <th>Ticket Status</th>
            <td>{{$ticket->status }}</td>
        </tr>
    </table>
    <hr>
    
    <div class="form-group">
    {{ Form::open(array('route' => 'comments.store')) }}
        <input type="hidden" name ="ticket_id" value="{{$ticket->id}}">
        {{ Form::label('comment', 'Enter Comment') }}
            {{ Form::text('comment', null, array('class' => 'form-control')) }}
            
        <br>   

        {{ Form::submit('Submit Comment', array('class' => 'btn btn-success btn-lg')) }}
        {{ Form::close() }}
    </div>
    <hr>
    <ul>
        @foreach($comments as $comment)
        <li style="list-style-type:none">
        <span>{{$comment->comment}}</span>Comment By :- 
        @if($comment->name == Auth::user()->name)
        Me
        @else
        {{$comment->name}}
        @endif
        </li>
        @endforeach
    </ul>

    <!-- {!! Form::open(['method' => 'DELETE', 'route' => ['tickets.destroy', $ticket->id] ]) !!}
    @can('ticket edit')
    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete ticket')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!} -->

</div>

@endsection