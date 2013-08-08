<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield_content('title')</title>
	@include('template.global.css')
	<style type="text/css">
    .form-signin {
      max-width: 520px;
      padding: 19px 29px 29px;
      margin: 20px auto;
      background-color: #222;
      border: 1px solid #333;
      -webkit-border-radius: 5px;
         -moz-border-radius: 5px;
              border-radius: 5px;
      -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
         -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
              box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
		.form-signin .signin {
			padding-left: 40px;
			display: inline-block;
			width: 300px;
		}
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
      font-size: 16px;
      height: auto;
      margin-bottom: 15px;
      padding: 7px 9px;
    }
		.form-signin .disclaimer {
			margin: 30px 0 0;
			color: #888;
		}
  </style>
	@include('template.global.scripts')
</head>
<body>
	<div class="container">
		@yield_content('content')
	</div>
</body>
</html>