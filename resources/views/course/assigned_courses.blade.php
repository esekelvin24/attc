@extends('../layouts.dash_layout')

@section('required_css')

@endsection



@section('content')
	<div class="content-box">
		<div class="element-wrapper">
			<h6 class="element-header">
				All Assigned Courses List (@if( $course_collection->isEmpty() ) 0 @else{{$course_collection->count()}}@endif)
			</h6>
			@if(Session::get('course_success'))
			<div class="alert alert-success" style="margin-top:3px; margin-bottom:0">
				News Updated successfully!
			</div>
			<br/>
			@endif

			@if(Session::get('course_error'))
			<div class="alert alert-error" style="margin-top:3px; margin-bottom:0">
				An error occurred when performing updates!
			</div>
			<br/>
			@endif

			
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
					<table id="dataTable1" class="table table-striped" style="width: 100% !important;">
						<thead>
							<tr>
                                @if(Route::current()->getName() == 'assigned_courses')
								<th></th>
                                @endif
								
								<th>Programme</th>
								<th>Course</th>
								<th>Course Category</th>
								<th>Course Unit</th>
								<th>Course Year</th>
								<th>Semester</th>
								<th>Date</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                                @if(Route::current()->getName() == 'assigned_courses')
								<th></th>
                                @endif
								
								<th>Programme</th>
								<th>Course</th>
								<th>Course Category</th>
								<th>Course Unit</th>
								<th>Course Year</th>
								<th>Semester</th>
								<th>Date</th>
							</tr>
						</tfoot>
						<tbody>
						@foreach($course_collection as $val)
							<tr>
                                @if(Route::current()->getName() == 'assigned_courses')
								<td>

										<i title="Edit {{ $val->course_title }}" style="cursor: pointer" data-id="{{ $val->course_id }}" class="fa fa-edit"></i>
								</td>
							
								@endif
								<td>{{$val->name}}</td>
								<td>{{$val->course_title}}</td>
								<td>{{$val->category==1?"Mandatory":"Elective"}}</td>
								<td>{{$val->unit}}</td>
								<td>{{$val->year}}</td>
								<td>{{$val->semester}}</td>
								<td>{{$val->creation_date}}</td>
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

	$('body').on('click','i[data-id]',function(e)//fetching edit form from the server
			{
				e.preventDefault();

				var no=$(this).data("id");
				//alert(no);
				var toks=$("input[name='_token']").val();

				$.ajax(
						{
							type:"POST",
							data:{id:no, _token:toks},
							@if(Route::current()->getName() == 'edit_course')
							url:"{{ route('dynamic_course_edit') }}",
							@else
							url:"{{ route('dynamic_course_edit') }}",
							@endif
							beforeSend:function()
							{
								$('table').block({ message: null });
								$('div.modal-body').attr("data-print",no);
							},
							success: function(r)
							{
								$('table').unblock();
								$('div.modal-body').html(r);
								$('.edit_area').modal(
										{
											backdrop: 'static',
											keyboard: false
										});

							}
						}

				);
			});




	/*$("#staff_pic").on('change', function() {

		var iden=$(this).attr('id');

		if(iden=="staff_pic")
		{
			var ext1=$.trim($('input[name="staff_pic"]').val().split('.').pop().toLowerCase());
			if(($.inArray(ext1, ['gif','png','jpg','jpeg']) == -1)  )
			{
				$('input[name="staff_pic"]').val("");
				$("#user-container").empty();
				sweetAlert("Oops...", "Invalid File Formats. Only Image File Formats like jpg, png, gif Allowed!", "error");
			}
			else
			{

				if (typeof(FileReader) == "undefined")
				{
					alert("Your browser doesn't support HTML5, Please use an upgraded version of Chrome or Mozilla Firefox");
				}
				else
				{

					var container = $("#user-container");

					//remove all previous selected files
					container.empty();

					//create instance of FileReader
					var reader = new FileReader();
					reader.onload = function(e) {
						$("<img />", {
							"src": e.target.result,
							"width": 150,
							"height":150,
							"class":"img-rounded"
						}).appendTo(container);
					}

					reader.readAsDataURL($(this)[0].files[0]);
				}
			}
		}

	});*/

	/*Rights things
	$('form').on('change','select#rights_id',function(e)
	{
		var id=$(this).val();
		var toks=$("input[name='_token']").val();
		if(id!=="")
		{
			$.ajax(
					{
						type:"POST",
						data:{rights_id:id,
							_token:toks
						},
						url:"{{ route('get_user_rights') }}",
						beforeSend:function()
						{
							$('select#rights_id').block({ message: null });
						},
						success: function(r)
						{
							$('select#rights_id').unblock();

							$('div#here').html(r);
						}
					}
			);
		}else{
			$('div#here').html("Kindly select a Global Right in order to edit associated privileges");
		}

	});

	$('body').on('click','button.edit_staff',(function(e)//saving edited form
	{
		e.preventDefault();
		var formData = new FormData($('form#formValidate')[0]);

		$.ajax(
				{
					type:"POST",
					data:formData,
					url:"{{route('save_edits')}}",
					cache:false,
					contentType:false,
					processData:false,
					beforeSend:function()
					{
						$('form#formValidate').block({ message: null });
					},
					error: function(r)
					{
						$('form#formValidate').unblock();

						const errors = r.responseJSON.errors;
						var first=true;

						//clear any previous errors
						$('div.error-message').html('');
						$('div.has-error').removeClass('has-error');


						$.each(errors,function(index,value)
						{
							var others_re= new RegExp("^others");
							var staff_docs_re= new RegExp("^staff_docs");
							var g_things= new RegExp("^g_");

							var others_re_result=others_re.test(index);
							var staff_docs_re_result=staff_docs_re.test(index);
							var g_things_result=g_things.test(index);


							//for first item, kindly scroll into view
							if(first && (!others_re_result && !staff_docs_re_result && !g_things_result) )
							{
								$('html, body').animate({scrollTop:$('#'+index).offset().top-90},2000);
								$('#'+index).focus();
							}

							if(others_re_result || staff_docs_re_result || g_things_result )
							{
								if(first && g_things_result)
								{

									$('html, body').animate({scrollTop:$('table.guarantor').offset().top-90},2000);
									$('input[name^="g_"]').focus();
									sweetAlert("Oops...", "Guarantor Phone or Email in invalid Format", "error");
								}


								if(first && others_re_result)
								{
									$('input[name^="others"]').next('span.error-message').html(''+value);
									$('input[name^="others"]').closest('div.form-group').addClass('has-error');

									$('html, body').animate({scrollTop:$('input[name^="others"]').offset().top-90},2000);
									$('input[name^="others"]').focus();
									sweetAlert("Oops...", value, "error");
								}

								if(first && staff_docs_re_result)
								{
									$('input[name^="staff_docs"]').next('span.error-message').html(''+value);
									$('input[name^="staff_docs"]').closest('div.form-group').addClass('has-error');

									$('html, body').animate({scrollTop:$('input[name^="staff_docs"]').offset().top-90},2000);
									$('input[name^="staff_docs"]').focus();
									sweetAlert("Oops...", value, "error");
								}

							}
							else
							{
								$('#'+index).next('span.error-message').html(''+value);
								$('#'+index).closest('div.form-group').addClass('has-error');
							}



							first=false;
						})



					},
					success: function(r)
					{
						$('form#formValidate').unblock();

						//clear any previous errors
						$('div.error-message').html('');
						$('div.has-error').removeClass('has-error');
						$('div.has-success').removeClass('has-success');
						//clear all items
						$("#user-container").empty();
						$('form#formValidate')[0].reset();
						$('div#here').html("");
						$('div.others_docs_here').html("");



						$('html, body').animate({scrollTop:$('body').offset().top-90},2000);
						swal("success!", "Edits were successfully saved", "success");
						window.location.reload();
					}

				}
		);


	}));//end of saving edited form*/


	</script>
@endsection
