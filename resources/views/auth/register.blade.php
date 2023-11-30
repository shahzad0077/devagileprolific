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
    <title>Signup</title>
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
                                    <a href="{{url('/login')}}" >Sign in</a>
                                </div>
                                <div>
                                    <a href="{{url('/register')}}" class="active">Create account</a>
                                </div>
                            </div>
                        </div>
                        <div class="input-fields-area py-lg-10">
                            <h3>Create new account</h3>
                            <form class="needs-validation pt-7" method="POST" action="{{ route('register') }}">
                               @csrf 
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="FirstName" required>
                                            <label for="FirstName">First Name</label>
                                       
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback mb-3 ml-5 mt-0" style="display:block !important" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" name="last_name" id="LastName" required>
                                            <label for="LastName">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group mb-0">
                                            <select class="form-select form-control shadow-effect" aria-label="Default select example">
                                                <option value="1">Sales </option>
                                                <option value="2">Human Resource</option>
                                                <option value="3">Finance</option>
                                            </select>
                                            <label for="LastName">Work industry</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group mb-0">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" required>
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
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" onkeyup="passwordValidation();" name="password" id="Password" required>
                                            <label for="Password">Password</label>
                                        
                                            <span class="toggle-password" onclick="togglePasswordVisibility('Password')"><i class="fas fa-eye"></i></span>
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
                                            <input type="password" class="form-control" id="ConfirmPassword"  name="password_confirmation" required>
                                            <label for="ConfirmPassword">Confirm Password</label>
                                            <span class="toggle-password" onclick="togglePasswordVisibility('ConfirmPassword')"><i class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    
                                       <div class="col-md-12">
                                     <div id="popover-password" style="display:none;">

                                    <ul class="list-unstyled mt-2" style="font-size:14px">
                                        <li class="">
                                            <span class="low-upper-case">
                                                <i class="fas fa-check" aria-hidden="true"></i>
                                                &nbsp;Lowercase &amp; Uppercase
                                            </span>
                                        </li>
                                        <li class="">
                                            <span class="one-number">
                                                <i class="fas fa-check" aria-hidden="true"></i>
                                                &nbsp;Number (0-9)
                                            </span>
                                        </li>
                                        <li class="">
                                            <span class="one-special-char">
                                               <i class="fas fa-check" aria-hidden="true"></i>
                                                &nbsp;Special Character (!@#$%^&*)
                                            </span>
                                        </li>
                                        <li class="">
                                            <span class="eight-character">
                                                <i class="fas fa-check" aria-hidden="true"></i>
                                                &nbsp;Atleast 8 Character
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 py-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" required value="" id="flexCheckDefault">
                                            <label class="form-check-label ml-3 mt-1" for="flexCheckDefault">
                                                I agree to the terms & Conditions
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 py-2">
                                        <button class="btn btn-primary btn-lg btn-theme btn-block" id="password-button">Signup</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row pt-5">
                                <div class="col-md-12">
                                    <h2 class="separator-hr"><span>Or</span></h2>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-12 text-center">
                                    <p>already have an account? <a href="{{url('/login')}}">Sign in</a> </p>
                                </div>
                            </div>
                            <div class="row social-buttons">
                                <div class="col-xl-4 col-lg-4 col-md-4 p-2">
                                    <button class="btn btn-white btn-block">
                                        <img src="{{asset('public/assets/images/icons/google.svg')}}">
                                       <a href="{{url('/auth/google')}}" class="btn"> Google</a>
                                    </button>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 p-2">
                                    <a href="{{url('/auth/facebook')}}">
                                    <button class="btn btn-white btn-block">
                                        <img src="{{asset('public/assets/images/icons/facebook.svg')}}">
                                        Facebook
                                    </button>
                                    </a>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 p-2">
                                    <button class="btn btn-white btn-block">
                                        <img src="{{asset('public/assets/images/icons/apple.svg')}}">
                                        Apple
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            @include('components.authsidebar')

        
        </div>
    </div>
</body>
<!-- MDB -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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

// function CheckPassword() 
//         { 
//           var passw =  /^[a-zA-Z0-9]{8,}$/;
//           var password = $("#Password").val();
//              if($("#Password").val() == null)
//              {
//               $("#pswmessage").html('');
//               return true;

//              }
//             if(password.match(passw)) 
//             { 
//               $("#pswmessage").html("");
             
//             }
//             else
//             { 
//               $("#pswmessage").html('<strong class="text-muted">Your password must be more than 8 characters long,should contain at-least 1 Uppercase,1 Lowercase,1 Numeric and 1 special character.</strong>');
             
            
//             }
//         }
function passwordValidation()
{
 regexPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
 inputTextVal = document.getElementById("Password");
if(inputTextVal.value.match(regexPattern))
 {
// document.getElementById("pswmessage").innerHTML ='';
$('#password-button').attr('disabled',false);

 }
else
 {
// document.getElementById("pswmessage").innerHTML = '<ul class="mt-1 mb-0" style="font-size:14px" id="message" class="error-message-register"><li id="letter" class="invalid one-number"><i class="icofont-tick-mark"></i> Lowercase Letter</li><li id="capital" class="invalid"><i class="icofont-tick-mark"></i> One Capital Letter</li><li id="number" class="invalid"><i class="icofont-tick-mark"></i> One Numeric Digit</li><li id="length" class="invalid"><i class="icofont-tick-mark"></i> Minimum 8 characters</li></ul>';
$('#password-button').attr('disabled',true);

 }
 if(inputTextVal.value == '')
 {
// document.getElementById("pswmessage").innerHTML ='';
document.getElementById("popover-password").style.display = "none"; 
 }
}
</script>
<script>

let state = false;
let password = document.getElementById("Password");

let lowUpperCase = document.querySelector(".low-upper-case");
let number = document.querySelector(".one-number");
let specialChar = document.querySelector(".one-special-char");
let eightChar = document.querySelector(".eight-character");

password.addEventListener("keyup", function() {
    let pass = document.getElementById("Password").value;
  
    document.getElementById("popover-password").style.display = "block"; 
    checkStrength(pass);
});

function checkStrength(password) {
    let strength = 0;

    //If password contains both lower and uppercase characters
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
        strength += 1;
        // lowUpperCase.classList.remove('fa-circle');
        lowUpperCase.style.color  = "#10c25a";
    } else {
        // lowUpperCase.classList.add('fa-circle');
          lowUpperCase.style.color  = "black";
    }
    //If it has numbers and characters
    if (password.match(/([0-9])/)) {
        strength += 1;
        number.style.color  = "#10c25a";
        // number.classList.add('fa-check');
    } else {
        // number.classList.add('fa-circle');
        number.style.color  = "black";
    }
    //If it has one special character
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
        // specialChar.classList.remove('fa-circle');
        specialChar.style.color  = "#10c25a";
    } else {
        // specialChar.classList.add('fa-circle');
        specialChar.style.color  = "black";
    }
    //If password is greater than 7
    if (password.length > 7) {
        strength += 1;
        // eightChar.classList.remove('fa-circle');
        eightChar.style.color  = "#10c25a";
    } else {
        // eightChar.classList.add('fa-circle');
        eightChar.style.color  = "black";
    }


}
</script>

</html>