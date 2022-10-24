<?php
include 'koneksi.php';
if(isset($_SESSION['id'])) header("location:dashboard.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login/Signup Form</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="asset/css/style.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
  
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3">
              <span>Log In </span>
              <span>Sign Up</span>
            </h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
            <label for="reg-log"></label>

            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Log In</h4>
											<form action="#" method="post"  id="LoginForm">
												<div class="form-group">
												<input type="text" id="username" name="username" placeholder="Your Username" class="form-style" required>
												<i class="input-icon uil uil-user"></i>
												</div>  
												<div class="form-group mt-2">
													<input type="password" id="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off" required="required">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<input type="submit" value="Log in" name="login" id="login" class="btn" >
													<p class="mb-0 mt-4 text-center">

											</form>
                          <a href="#0" class="link">Forgot your password?</a>
                        </p>
                    </div>
                  </div>
                </div>

                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Sign Up</h4>
											<form action="" method="post"  id="SIGNUPFORM">
												<div class="form-group">
													<input type="text" name="fullname" class="form-style" placeholder="Your Full Name" id="fullname" autocomplete="off">
													<i class="input-icon uil uil-user"></i>
												</div>  
												<div class="form-group mt-2">
													<input type="text" name="username" class="form-style" placeholder="Your username" id="username" autocomplete="off">
													<i class="input-icon uil uil-user"></i>
												</div>  
												<div class="form-group mt-2">
													<input type="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off" >
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<input type="submit" value="Sign Up" id="register" name="register" class="btn">
											</div>

											</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
   integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
  
  <script>

$("#SIGNUPFORM").submit( (e) => {
      e.preventDefault();
      var form = $("#SIGNUPFORM").serialize();
      
      $.ajax({
        url : "ajax.php",
        method: 'post',
        data: form,
        success: function(res) {
          if(res === 'successs'){
            Swal.fire({
              icon: 'success',
              title: 'Nice',
              text: 'Register Successfully',
              timer: 2000,
              showConfirmButton: true,
              confirmButtonColor:'#444444',
              iconColor: '#444444',
            })
    
            setInterval(function(){
              location.reload()
              },3000)
            
    
          }else {
            Swal.fire({
              icon: 'error',
              title: 'Something went wrong',
              text: res,
              timer: 3000,
              showConfirmButton: true,
              confirmButtonColor:'#444444',
              iconColor: '#444444',
            })
    
          }
            $("#SIGNUPFORM")[0].reset();
            
         }
      })
    })
    
    
    $("#LoginForm").submit( (e) => {
      e.preventDefault();
      
      var form_login = $("#LoginForm").serialize();
      $.ajax({
         url : "ajax.php",
         method: 'POST',
         data: form_login,
         success: function(res) {
            var data = $.parseJSON(res);
            var name = document.querySelector('#username').value;
            if (data.status == 'success'){
    
              Swal.fire({
                icon: 'success',
                title: 'Login Success',
                text: 'Nice one',
                html:
                '<b>Welcome back, '+ name +'<br> </b>'+
                'change page in <strong></strong> sec.',
                timer: 5000,
                showConfirmButton: false,
                iconColor: '#444444',
                didOpen: () => {
                  
                  timerInterval = setInterval(() => {
                    Swal.getHtmlContainer().querySelector('strong')
                    .textContent = (Swal.getTimerLeft() / 1000)
                    .toFixed(0)
                  }, 100)
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              })
            }else if (data.status == 'errors')  {
              Swal.fire({
                icon: 'error',
                title: 'Something Went Wrong',
                text: 'Fill Out The Form',
                timer: 3000,
                showConfirmButton: true,
                confirmButtonColor:'#444444',
                iconColor: '#444444',
              })
              return false;
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Something Went Wrong',
                text: 'Your Password Not Match',
                timer: 3000,
                showConfirmButton: true,
                confirmButtonColor:'#444444',
                iconColor: '#444444',
              })
              return false;
            }
    
    
            setInterval(function(){
            location.href = "dashboard.php"
            },5000)
          }
        })
      })
      </script>
</body>
</html>