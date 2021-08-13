<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>emt | inspect </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/users/pass_recovery_1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="pass-recovery">

    <form method="POST" class="form-pass-recovery" action="{{ route('certificate.upload') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success col-12" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="col-md-12 text-center mb-4">
                <img alt="logo" src="assets/img/logo-5.png" class="theme-logo">
            </div>
            <div class="col-md-12">
                <h4>Upload certificate</h4>
                <p>Please upload the CRT and KEY files</p>
            </div>
            <div class="col-md-12">
                <label for="crt" class="">CRT File</label>                
                <input id="crt" type="file" class="form-control @error('crt') is-invalid @enderror" name="crt" value="{{ old('crt') }}" required>
                @error('crt')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <label for="key" class="">KEY File</label>                
                <input id="key" type="file" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required>
                @error('key')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <button class="btn btn-lg btn-gradient-danger btn-block btn-rounded mb-4 mt-5" type="submit">Upload</button>
            </div>
        </div>
    </form>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script>
    </script>
</body>
</html>