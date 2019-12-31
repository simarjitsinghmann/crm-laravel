@extends('layouts.app')

@section('title', '| View ticket')

@section('content')

<div class="container">
    <div class="grid__item">
    <h1 class="d-inline">Ticket ID :- {{ $ticket->id }}</h1><a href="{{ route('list',$customer->id) }}" class="btn btn-primary d-inline">Back</a>
    </div>
    <hr>

    <h2>Ticket Title :- {{$ticket->title}}</h2>
    <hr>
    <form class="mbr-form form-active" action="{{route('ticketupdate',$ticket->id)}}" method="POST">
        @csrf
        <input type="hidden" data-form-email="true" >
        <input type="hidden" name="id" value="{{$customer->id}}" >
                        <div class="row row-sm-offset">
                            <div class="col-md-6 multi-horizontal" data-for="first_name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="first_name-form1-4t">First Name</label>
                                    <input type="text" class="form-control" name="first_name"  value="{{$customer->first_name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="last_name">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="last_name-form1-4t">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$customer->last_name}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="address1">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="address1-form1-4t">Address 1</label>
                                    <input type="text" class="form-control" name="address1" value="{{$customer->address1}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="address2">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="address2-form1-4t">Address 2</label>
                                    <input type="text" class="form-control" name="address2" value="{{$customer->address2}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="city">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="city-form1-4t">City</label>
                                    <input type="text" class="form-control" name="city" value="{{$customer->city}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="country">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="country-form1-4t">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{$customer->city}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="contact">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="contact-form1-4t">Phone</label>
                                    <input type="tel" class="form-control" name="contact" data-form-field="contact" id="contact-form1-4t" value="{{hidecontact($customer->contact)}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="email">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="email-form1-4t">Email</label>
                                    <input type="email" class="form-control" name="email" data-form-field="Email" required="" id="email-form1-4t" value="{{hideEmail($customer->email)}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="vendor">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="vendor-form1-4t">Vendor TFN</label>
                                    <input type="text" class="form-control" name="vendor" value="{{$ticket->vendor}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="amount">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="amount-form1-4t">Sale Amount</label>
                                    <input type="text" class="form-control" name="amount" value="{{$ticket->amount}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 multi-horizontal" data-for="plan">
                                <div class="form-group">
                                    <label class="form-control-label mbr-fonts-style display-7" for="plan-form1-4t">Plan</label>
                                    <input type="text" class="form-control" name="plan" value="{{$ticket->plan}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-for="title">
                            <label class="form-control-label mbr-fonts-style display-7" for="title-form1-4t">Title of Ticket</label>
                            <input type="text" class="form-control" name="title" value="{{$ticket->title}}" disabled>
                        </div>
                        <div class="form-group" data-for="description">
                            <label class="form-control-label mbr-fonts-style display-7" for="description-form1-4t">Description</label>
                            <textarea type="text" class="form-control" name="description" rows="5" data-form-field="Message" id="message-form1-4t" disabled>{{$ticket->description}}</textarea>
                        </div>
                       
                        <div class="form-group" data-for="solution">
                            <label class="form-control-label mbr-fonts-style display-7" for="solution-form1-4t">Solution</label>
                            
                            @if($ticket->solution != '')
                            <textarea type="text" class="form-control" name="solution-disabled" rows="5" disabled>{{$ticket->solution}}</textarea>
                             @else
                             @hasanyrole('tech')
                            <textarea type="text" class="form-control" name="solution" rows="5"></textarea>
                            @else
                            <textarea type="text" class="form-control" name="solution-disabled" rows="5" disabled>Tech Not Provided Any Solution</textarea>
                            @endhasanyrole
                            
                            @endif
                           
                        </div>
                        @role('customer')
                        @if($ticket->feedback != '')
                        <div class="form-group" data-for="feedback">
                            <label class="form-control-label mbr-fonts-style display-7" for="feedback-form1-4t">Customer Feedback</label>
                            <textarea type="text" class="form-control" name="feedback-disabled" rows="5" disabled>{{$ticket->feedback}}</textarea>
                        </div>
                        <div class="form-group" data-for="rating">
                            <label class="form-control-label mbr-fonts-style display-7" for="rating-form1-4t">Rating</label>
                            <textarea type="text" class="form-control" name="rating-disabled" rows="5" disabled>{{$ticket->rating}}</textarea>
                        </div>
                        @else
                        <div class="form-group" data-for="feedback">
                            <label class="form-control-label mbr-fonts-style display-7" for="feedback-form1-4t">Customer Feedback</label>
                            <textarea type="text" class="form-control" name="feedback" rows="5"></textarea>
                        </div>
                        <div class="form-group" data-for="rating">
                            <label class="form-control-label mbr-fonts-style display-7" for="rating-form1-4t">Rating</label>
                            <input type="radio" class="form-control-label" name="rating" value="1">1
                            <input type="radio" class="form-control-label" name="rating" value="2">2
                            <input type="radio" class="form-control-label" name="rating" value="3">3
                            <input type="radio" class="form-control-label" name="rating" value="4">4
                            <input type="radio" class="form-control-label" name="rating" value="5">5
                            <input type="radio" class="form-control-label" name="rating" value="6">6
                            <input type="radio" class="form-control-label" name="rating" value="7">7
                            <input type="radio" class="form-control-label" name="rating" value="9">9
                            <input type="radio" class="form-control-label" name="rating" value="10">10
                        </div>
                        @endif
                        @endrole
                        @can('ticket edit')
                        @if($ticket->solution == '' || $ticket->feedback == '')
                        <span class="input-group-btn">
                            <button href="" type="submit" class="btn btn-success btn-lg btn-block">Update Ticket</button>
                        </span>
                        @endif
                        @endcan
                        
                    </form>

</div>

@endsection