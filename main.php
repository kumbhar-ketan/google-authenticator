 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Authenticator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="offset-md-4 col-md-4 mt-5">
        <div class="card text-center">
            <div class="card-header test">Google Authenticator</div>
            <div class="card-body">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address"/>
                    <span id="img"></span>
                    <button type="button" name="generate" class="form-control btn btn-success mt-1">Generate QR code</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(document).on('click','button[name="generate"]',function(){
                if($('#email').val() != ''){
                    $('#email').next().html('');
                    $.post('generate.php',{email: $('#email').val()},function(response){
                        if(response == 'error'){

                        }else{
                            if(response.url){
                                custom = '<label class="form-control-label">Scan this Image:</label>';
                                custom += '<img src="'+response.url+'" title="Scan this QR code" class="form-control img-responsive img-bordered" />';
                                custom += '<input type="text" id="code" name="code" placeholder="Enter QR code generated in Google Auth App" class="form-control" />';
                                $('#img').html(custom);
                                $('button[name="generate"]').text('Verify');
                                $('button[name="generate"]').attr('name','verify');
                            }
                        }
                    },"json");
                }else{
                    if(!$('#email').next().children().hasClass('label')){
                        $('#email').next().prepend('<label class="label">Please enter email</label>');
                    }
                }
            });

            $(document).on('click','button[name="verify"]',function(){
                $.post('verify.php',{email: $('#email').val(),code: $('#code').val()},function(response){
                    if(response.status == 'error'){
                        alert('Not Matched');
                    }else{
                        alert('Matched');
                    }
                },"json");
            });
        });
    </script>
</body>
</html>