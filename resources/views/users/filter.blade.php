@extends('layouts.app')
@section('content')
        <div class="panel panel-default" style="width: 100%;">
            <div class="panel-heading">
                <h3>User Filter </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-sm-12">
                            <strong>Role:</strong>
                            <select name="roles" class="roles form-control">
                                <option value="">Select Role</option>
                                <option value="tech">Tech</option>
                                <option value="sales">Sales</option>
                                <option value="customer">Customer Support</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3 col-sm-12">
                            <strong>Select User:</strong>
                            <select name="users" class="users form-control">

                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3 col-sm-12">
                            <strong>Month & Year:</strong>
                            <input name="startDate" id="datepicker" class="datepicker form-control" /></div>
                        <div class="col-sm-6 col-md-3 col-sm-12 pt-4">
                            <button class="search-user btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="details">
                asdasd
                </div> 
                <table class="table user-table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Created Date</th>
                            <th>Ticket Title</th>
                            <th>Ticket Description</th>
                            <th>Ticket Solution</th>
                            <th>Ticket Feedback</th>
                            <th>Status</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
@endsection('content')
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
    <script>
    $(document).ready(function(){
            $(".datepicker").datepicker({ 
		dateFormat: 'mm-yy',
		changeMonth: true,
	    changeYear: true,
	    showButtonPanel: true,

	    onClose: function(dateText, inst) {  
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
            $(this).datepicker('setDate', new Date(year, month, 1)); 
        }
	});
	
	$(".datepicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $(".ui-datepicker-buttonpane .ui-datepicker-current").hide();
        $(".ui-datepicker-title select").css('background','#2f75d8');
		$("#ui-datepicker-div").position({
			  my: "center top",
			  at: "center bottom",
			  of: $(this)
			});
		

        });
    });
    </script> 
@endsection('scripts')