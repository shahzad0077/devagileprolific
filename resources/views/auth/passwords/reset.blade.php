<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">
    <title>Login</title>
    <style type="text/css">
    </style>
</head>

<body>
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white">
            <!--begin::Aside-->
            <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                <!--begin: Aside Container-->
                <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-10 px-lg-30">
                    <div class="d-flex flex-column-fluid flex-column flex-center">
                        <div class="login-nav-links pt-md-1 pb-md-3 pt-sm-5 px-lg-0 pt-5 px-7">
                            <div class="d-flex flex-row">
                                <div>
                                    <a href="{{url('/login')}}" class="active">Sign in</a>
                                </div>
                                <div>
                                    <a href="{{url('/register')}}">Create account</a>
                                </div>
                            </div>
                        </div>
                        <div class="input-fields-area py-lg-10">
                            
                <div class="card-body">
                    <form method="POST" class="needs-validation pt-7" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group mb-0">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    <label for="email">Email</label>
                                                                              
                                  
                                </div>
                            </div>
                            @error('email')
                            <span class="invalid-feedback mb-3 ml-5 mt-0" style="display:block !important" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                          
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group mb-0 position-relative">
                                    <input id="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="Password">Password</label>
                            </div>
                              
                            </div>
                            @error('password')
                            <span class="invalid-feedback mb-3 ml-5 mt-0" style="display:block !important" role="alert">
                            <strong>{{ $message }}</strong>
                           </span>
                             @enderror
                             <span class="mb-3 ml-5 mt-0" id="pswmessage" role="alert">
                                
                             </span>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group mb-0 position-relative">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                </div>
                            </div>
                         
                            <div class="col-md-12 py-2">
                                <button class="btn btn-primary btn-lg btn-theme btn-block" id="password-button">{{ __('Reset Password') }}</button>
                            </div>
                        </div>

                      
                    </form>
                </div>
                         
                          
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Aside-->
            @include('components.authsidebar')
            <!--begin::Content-->
        
        </div>
    </div>
</body>
<!-- MDB -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script type="text/javascript">
function togglePasswordVisibility(fieldId) {
    const passwordField = document.querySelector(`#${fieldId}`);
    const icon = document.querySelector(`[onclick="togglePasswordVisibility('${fieldId}')"] i`);

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function passwordValidation()
{
 regexPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
 inputTextVal = document.getElementById("Password");
if(inputTextVal.value.match(regexPattern))
 {
document.getElementById("pswmessage").innerHTML ='';
$('#password-button').attr('disabled',false);

 }
else
 {
document.getElementById("pswmessage").innerHTML = '<ul class="mt-1 mb-0" style="font-size:14px" id="message" class="error-message-register"><li id="letter" class="invalid"><i class="icofont-tick-mark"></i> Lowercase Letter</li><li id="capital" class="invalid"><i class="icofont-tick-mark"></i> One Capital Letter</li><li id="number" class="invalid"><i class="icofont-tick-mark"></i> One Numeric Digit</li><li id="length" class="invalid"><i class="icofont-tick-mark"></i> Minimum 8 characters</li></ul>';
$('#password-button').attr('disabled',true);

 }
 if(inputTextVal.value == '')
 {
document.getElementById("pswmessage").innerHTML ='';

 }
}
</script>

</html>