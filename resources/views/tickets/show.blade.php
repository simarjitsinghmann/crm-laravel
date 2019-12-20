@extends('layouts.app')

@section('title', '| View ticket')

@section('content')

<div class="container">

    <h1>{{ $ticket->title }}</h1>
    <hr>
    <p class="lead">{{ $ticket->body }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['tickets.destroy', $ticket->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit ticket')
    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete ticket')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection