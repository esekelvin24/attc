@extends('../layouts.dash_layout')

@section('required_css')

@endsection


@section('content')
	<div class="content-box">
		@if(Session::get('edit_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				Department edits were successful
			</div>
		@endif
		<div class="element-wrapper">
			<h6 class="element-header">
				Created Roles (@if( $roles_collection->isEmpty() ) 0 @else{{$roles_collection->count()}}@endif)
			</h6>
			<div class="element-box">
				<div class="table-responsive">
					<style>
						.form-inline{
							display: block !important;
						}
						ul.pagination a {
							position: relative;
							display: block;
							padding: 0.5rem 0.75rem;
							margin-left: -1px;
							line-height: 1.25;
							color: #047bf8;
							background-color: #fff;
							border: 1px solid #dee2e6;
						}
					</style>
					<form>
					  
					</form>
                    @if(Auth::user()->can('add-new-role'))
					<button id="new_role" class="btn btn-info text-white" style="background:#1F1D5E; margin-bottom: 15px;"><i class="fa fa-plus"></i> Add New Role</button>
					@endif
					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
						<tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Slug</th>
							<th>Description</th>
							<th>Action</th>
							
						</tr>
						</thead>
						<tfoot>
						<tr>
							
							<th>S/N</th>
							<th>Name</th>
							<th>Slug</th>
							<th>Description</th>
							<th>Action</th>
							
						</tr>
						</tfoot>
						<tbody>
						@foreach($roles_collection as $key=>$val)
							<tr>
								<th>{{$key+1}}</th>
								<td>{{$val->name}}</td>
								<td>{{$val->slug}}</td>
								<td>{{$val->description}}</td>
								<td>
                                  <button onclick="get_role_info('{{encrypt($val->id)}}')" type="button" class="btn btn-warning btn-sm btn-flat"><span class="btn-label"><i class="fa fa-info-circle"></i></span> Info</button>
                                  @if(Auth::user()->can('edit-role'))
								  <button onclick="edit_role_info('{{encrypt($val->id)}}')" type="button" class="btn  btn-success btn-sm btn-flat"><span class="btn-label"><i class="fa fa-edit"></i></span> Edit</button>
                                  @endif
								 </td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade edit_area" role="dialog">
		<div class="modal-dialog modal-lg">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<!-- //End Modal -->

@endsection

@section('required_js')
@endsection

@section('additional_js')
	<script>

		if ($('#dataTable1').length) {
			$('#dataTable1').DataTable({ buttons: ['copy', 'excel', 'pdf'] });
		}

        @if(Auth::user()->can('add-new-role'))
          $("#new_role").click(function()
		  {
             var toks=$("input[name='_token']").val();
             $.ajax(
					{
						type:"POST",
						data:{ _token:toks},
						url:"{{ route('add_new_role') }}",
						beforeSend:function()
						{
							$('table').block({ message: null });
						},
						success: function(r)
						{
							$('table').unblock();
							$('div.modal-body').html(r);
							$('.edit_area').modal({
										backdrop: 'static',
										keyboard: false
							});

						}
					}
			);
		  });
		  @endif


		  function get_role_info(id)
		  {
			var no= id;
			var toks=$("input[name='_token']").val();
             $.ajax(
					{
						type:"POST",
						data:{id:no, _token:toks},
						url:"{{ route('get_role_info') }}",
						beforeSend:function()
						{
							$('table').block({ message: null });
						},
						success: function(r)
						{
							$('table').unblock();
							$('div.modal-body').html(r);
							$('.edit_area').modal({
										backdrop: 'static',
										keyboard: false
							});

						}
					}
			);

		  }

          @if(Auth::user()->can('edit-role'))  
		  function edit_role_info(id)
		  {
            var no= id;
			var toks=$("input[name='_token']").val();
             $.ajax(
					{
						type:"POST",
						data:{id:no, _token:toks},
						url:"{{ route('edit_role') }}",
						beforeSend:function()
						{
							$('table').block({ message: null });
						},
						success: function(r)
						{
							$('table').unblock();
							$('div.modal-body').html(r);
							$('.edit_area').modal({
										backdrop: 'static',
										keyboard: false
							});

						}
					}
			);
		  }
		 @endif


      

	


	</script>
@endsection
