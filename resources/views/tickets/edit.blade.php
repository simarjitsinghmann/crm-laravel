@extends('layouts.app')

@section('title', '| Edit ticket')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit ticket</h1>
        <hr>
            {{ Form::model($ticket, array('route' => array('tickets.update', $ticket->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}<br>

            {{ Form::label('body', 'ticket Body') }}
            {{ Form::textarea('body', null, array('class' => 'form-control')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection