@extends('admin.admin_master')
@section('admin')
<div class="container-full">
			  

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Admin Profile Edit</h4>
			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form novalidate="">
					    <div class="row">
						    <div class="col-12">						
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Admin User Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="text" class="form-control" > 
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Admin Email Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control" > 
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Admin Profile Picture<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                    <input type="file" name="profile_photo_path" class="form-control" required=""> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
							
						    </div>
						
					    </div>
						
						
						
						<div class="text-xs-right">
							<button type="submit" class="btn btn-rounded btn-info">Submit</button>
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>
@endsection