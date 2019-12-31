@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-md-12 margin-tb">
      <div class="pull-left">
        <h2>Users Management</h2>
      </div>
      <div class="pull-right">
        <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
      </div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">
            @if($v=='superadmin')
            Super Admin
            @elseif($v=='sales')
            Sales
            @elseif($v=='tech')
            Tech
            @elseif($v=='customer')
            Customer Support
            @endif
           </label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}

</div>
</div>

@endsection