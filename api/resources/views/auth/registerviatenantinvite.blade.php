<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="jumbotron d-flex align-items-center" style="height:100%;">
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form id="form_reset_password">
                    <label>Enter Account Email</label>
                    <div class="form-group pass_show">
                        <input type="email" class="form-control" placeholder="Account Email" name="email" id="email">
                    </div>
                    <label>New Password</label>
                    <div class="form-group pass_show">
                        <input type="password" class="form-control" placeholder="New Password" name="password"
                            id="password">
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group pass_show">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            name="password_confirmation" id="password_confirmation">
                    </div>
                    <div class="form-group pass_show">
                        <button type="submit" class="btn btn-primary"> Save new Password</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        const invitetnanttoken='{{$_GET["token"]}}';
        $("#form_reset_password").submit(function(e){
            e.preventDefault();
            //ajax
$.ajax({
            url: '/api/change-password',
            method: 'POST',
            dataType: 'json',
            data: {email:$("#email").val(),password:$("#password").val(),password_confirmation:$("#password_confirmation").val(),invitetnanttoken:invitetnanttoken},
            success: function(data){
            console.log('succes: '+data);
            },
            error:function(error){
                console.log(error);
            }
            });
            //ajax
        })
        
    })
</script>