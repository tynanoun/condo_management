<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->

    <!-- App css -->
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>

</head>


<body class="bg-accpunt-pages">

<!-- HOME -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">

                    <div class="account-pages">
                        <div class="account-box">
                            <div class="account-logo-box text-center">
                                <h2 class="text-uppercase text-center">
                                    <a href="index.html" class="text-success">
                                        <span><img src="assets/images/logo.png" alt="" height="30"></span>
                                    </a>
                                </h2>
                                <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                <p class="m-b-0">Login to your Admin account</p>
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                        <div class=" m-b-20 input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}
                                            <span class="input-group-addon font-20"><i class="fa fa-envelope-o"></i></span>
                                            {{--<div class="col-md-6">--}}
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    @echo("testing");
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                            @endif
                                        {{--</div>--}}

                                        {{----}}
                                        {{--<input type="email" id="emailaddress" class="form-control" required=""  placeholder="Email">--}}
                                    </div>

                                    <div class="input-group m-b-20">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="password" required="" id="password" class="form-control" placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        {{--</div>--}}
                                    </div>
                                    <div class="form-group m-b-20">
                                        <div class="col-xs-12">

                                            <div class="checkbox checkbox-success">
                                                <input id="remember" type="checkbox" checked="">
                                                <label for="remember">
                                                    Remember me
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                        </div>
                                        <p class="m-b-20 m-t-50"><a href="recoverpw.html">Forgot your password?</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end card-box-->
                </div>
                <!-- end wrapper -->
            </div>
        </div>
    </div>
</section>
<!-- END HOME -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

</body>
</html>
