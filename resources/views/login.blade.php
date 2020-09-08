<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tire Speed</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ url('logintheme/images/icons/tirespeed.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('logintheme/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('logintheme/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('logintheme/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ url('logintheme/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('logintheme/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('logintheme/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('logintheme/css/main.css') }}">
<!--===============================================================================================-->

{{-- sweet js --}}

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		function showpass(){
			var x = document.getElementById("pass");
			if(x.type === "password"){
				x.type = "text";
				x.focus();
			}else{
				x.type = "password";
				x.focus();
			}
		}
	</script>
</head>
<body>
	
	<div class="limiter">		
		<div class="container-login100">
			<div class="wrap-login100">
				{{-- @if (isset(Auth::user()->email))
					<script>window.location="/admin";</script>
				@endif --}}
		
				
		

				{{-- <div class="login100-pic js-tilt" data-tilt>
					<img src="images/tslogo.png" alt="IMG">
				</div> --}}

				<form class="login100-form validate-form" action="{{ url('check') }}" method="POST">
					{{ csrf_field() }}
					<span class="login100-form-title">
						{{-- <img src="./images/group.png" alt="" srcset="" width="96px" height="96px"> --}}
						<img src="{{ url('images/tslogo.png') }}" alt="IMG" width="192px" height="79px" class="img-responsive">
					</span>
					@if (count($errors) > 0)
					<div class="wrap-input100 validate-input">
						<div class="alert alert-danger" style="position: absolute; top: 20%">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<ul>
								@foreach ($errors->all() as $error)
									<li>*{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
					@endif
					@if ($message = Session::get('error'))
					<div class="wrap-input100 validate-input">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>{{ $message }}</strong>
						</div>
					</div>
					@endif

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="ອີ​ເມວ">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" id="pass" placeholder="ລະ​ຫັດ​ຜ່ານ">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="text-center">
						<input type="checkbox" onclick="showpass()"> ສະ​ແດງ​ລະ​ຫັດ​ຜ່ານ
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							ເຂົ້າ​ສູ່​ລະ​ບົບ
						</button>
					</div>

					{{-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> --}}
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{ url('logintheme/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ url('logintheme/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ url('logintheme/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ url('logintheme/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ url('logintheme/vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ url('logintheme/js/main.js') }}"></script>

</body>
</html>