@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
	<!--breadcrumb-->
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		<div class="breadcrumb-title pe-3">Edit District </div>
		<div class="ps-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0 p-0">
					<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Edit District </li>
				</ol>
			</nav>
		</div>
	</div>
	<!--end breadcrumb-->
	<div class="container">
		<div class="main-body">
			<div class="row">

				<div class="col-lg-10">
					<div class="card">
						<div class="card-body">
							<form method="post" id="myForm" action="{{route('update.district')}}">
								@csrf

                            <input type="hidden" name="id" value="{{ $district->id }}">

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Division Name</h6>
								</div>
								<div class="form-group col-sm-9 text-secondary">
									<select class="form-select mb-3" name="division_id" aria-label="Default select example">
										<option selected="">select the division</option>
										@foreach($division as $item)
											<option value="{{ $item->id }}" {{ $item->id == $district->division_id ? 'selected' : '' }}>{{ $item->division_name }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">District Name</h6>
								</div>
								<div class="form-group col-sm-9 text-secondary">
									<input type="text" name="district_name" class="form-control" value="{{ $district->district_name }}"/>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




@endsection
