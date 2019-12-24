@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="panel panel-default" style="width: 100%;">
            <div class="panel-heading">
                <h3>Products info </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="text" class="form-controller" id="search" name="search"></input>
                    <input type="radio" name="search_field" value="email" checked >Email<input type="radio" name="search_field" value="contact" >Contact Number
                    <button class="search btn btn-primary">Search</button>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection('content')