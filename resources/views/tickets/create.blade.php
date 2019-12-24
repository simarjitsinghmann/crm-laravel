@extends('layouts.app')

@section('title', '| Create New Ticket')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <h1>Create New Ticket</h1>
        <hr>
        <form class="mbr-form form-active" action="{{route('tickets.store')}}" method="POST">
        @csrf
        <input type="hidden" data-form-email="true" >
                        <div class="row row-sm-offset">
                            <div class="col-md-6 multi-horizontal" data-for="first_name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="first_name-form1-4t">First Name</label>
                                    <input type="text" class="form-control" name="first_name" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="last_name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="last_name-form1-4t">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="address1">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="address1-form1-4t">Address 1</label>
                                    <input type="text" class="form-control" name="address1" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="address2">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="address2-form1-4t">Address 2</label>
                                    <input type="text" class="form-control" name="address2" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="city">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="city-form1-4t">City</label>
                                    <input type="text" class="form-control" name="city" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="country">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="country-form1-4t">Country</label>
                                    <input type="text" class="form-control" name="country" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="contact">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="contact-form1-4t">Phone</label>
                                    <input type="tel" class="form-control" name="contact" data-form-field="contact" id="contact-form1-4t">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="email-form1-4t">Email</label>
                                    <input type="email" class="form-control" name="email" data-form-field="Email" required="" id="email-form1-4t">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="vendor">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="vendor-form1-4t">Vendor TFN</label>
                                    <input type="text" class="form-control" name="vendor" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="amount">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="amount-form1-4t">Sale Amount</label>
                                    <input type="text" class="form-control" name="amount" required="">
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="plan">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="plan-form1-4t">Plan</label>
                                    <input type="text" class="form-control" name="plan" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-for="title">
                            <label class="form-control-label mbr-fonts-style display-7" for="title-form1-4t">Title of Ticket</label>
                            <input type="text" class="form-control" name="title" required="">
                        </div>
                        <div class="form-group" data-for="description">
                            <label class="form-control-label mbr-fonts-style display-7" for="description-form1-4t">description</label>
                            <textarea type="text" class="form-control" name="description" rows="5" data-form-field="Message" id="message-form1-4t"></textarea>
                        </div>
            
                        <span class="input-group-btn">
                            <button href="" type="submit" class="btn btn-success btn-lg btn-block">Create Ticket</button>
                        </span>
                    </form>
   
        </div>
        
    </div>

@endsection