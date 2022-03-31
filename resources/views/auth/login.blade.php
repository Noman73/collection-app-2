<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('storage/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('storage/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('storage/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('storage/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('storage/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('storage/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('storage/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">

			<div class="wrap-login100">
				<div class="ml-auto mr-auto">
					<div class="text-center">অর্ঘ্য-প্রস্বস্তি</div>
					<img style="width: 105px;height:120px;margin:0 auto" class="img-fluid circle d-block" src="{{asset('storage/adminlte/dist/img/logo.jpg')}}" alt="Logo">
					<div class="text-center">প্রিয়পরম শ্রীশ্রীঠাকুর অনুকূলচন্দ্র সৎসঙ্গ ফাউন্ডেশন, বাংলাদেশ<br/>Email: satsangfoundationbd@gmail.com<br/>মোবাইলঃ-০১৭৫৯১০৭৩০৫
					</div>
				</div>
				<marquee class="mb-4 mt-2" behavior="scroll" direction="left">{{App\Models\Scrolling::first()->description}}</marquee>
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('storage/adminlte/dist/img/onukul.jpg')}}" alt="IMG">
				</div>

				<form method="POST" action="{{route('login')}}" class="login100-form validate-form">
					@csrf
					@error('email')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					@error('password')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					@error('status')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<div class="wrap-input100 validate-input" data-validate = "Valid mobile is required: ex@abc.xyz">
						<input class="input100  @error('mobile') is-invalid @enderror" type="text" name="mobile" placeholder="01XXXXXXXXX">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="input-group">
						<label for="">show</label>
						<input type="checkbox" class="ml-1 mt-1" id="password-show">
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						
						<a class="txt2" href="{{ route('password.request') }}">
							পাসওয়ার্ড ভূলে গিয়েছেন ?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<!--===============================================================================================-->	
	<script src="{{asset('storage/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('storage/login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('storage/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('storage/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('storage/login/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script>
		$('#password-show').change(function(){
			console.log(this.checked);
			if(this.checked){
				$('#password').attr('type','text');
			}else{
				$('#password').attr('type','password');
			}
		})
	</script>
</body>
</html>