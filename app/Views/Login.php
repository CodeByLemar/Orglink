
<html lang="en">

<?= $this->include('core/header')  ?>

<style type="text/css">

    input::-webkit-input-placeholder {
        font-size: 15px;
    }

    .logo-image{
        margin-top : 100px;
    }

    .btn-custom{
        background-color: <?=  session('companydetails')[0]['PrimaryColor'] ?>;
        color: white;
        width: 100%;
    }
    .btn-custom:hover {
        background-color: <?=  session('companydetails')[0]['PrimaryColor'] ?>;
        color:white;/* Change this to your desired hover color */
    }

</style>

<body >


<section class="vh-100" style="background-color: #ffffff;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block sidecolor " >
                            <img class="img-fluid logo-image"  id="imglogo" src="assets/images/System/<?=  session('companydetails')[0]['CompanyLogo'] ?>">
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">


                                <div class="text-center" >
                                    <img  class="img-fluid "src="assets/images/System/<?=  session('companydetails')[0]['SystemLogo'] ?>" width="40%">
                                </div>


                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Username</label>
                                    <input name="Uname" id="Uname" placeholder="Username" type="text"
                                           class="form-control"  />

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example27">Password</label>
                                    <div class="input-group mb-3">
                                        <input  name="password" id="password" placeholder="Password here..." type="password" class="form-control" value="" />
                                        <button class="btn" type="button" id="showpass"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>

                                <div class="pt-1 mb-4" align="right">
                                    <button type="button" class="btn btn-custom btn-lg btn-block"  id="LoginUser"><b>Login</b></button>
                                </div>

                                <div class="float-left"><a href="javascript:void(0);" class="btn-lg btn btn-link" id="RecoverPass">Recover Password</a></div>

                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="remember_me_val">
<?= $this->include('core/footer')  ?>

<script>
    var baseUrl = "{{ url('api') }}";


    $(document).ready(function(){
        $('#showpass').hide();

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {

                $('#LoginUser').click();
            }
        });



        $("#LoginUser").click(function(){


            var username = $("#Uname").val();
            var password = $("#password").val();

            var message  = (username == '' && password == '' ? 'Username and password is empty' : (username == '' ? 'Username is Empty' : 'Password Is Empty') )

            var icon  = (username == '' && password == '' ? 'error' : (username == '' ? 'warning' : 'warning') )


            var AlertResult = {
                'tittle' : 'Opps',
                'icon'   : icon,
                'Message': message
            };

            var data = {
                Uname: $('#Uname').val(),
                Password: $('#password').val(),
            }

            return (username == '' || password == '' ? Message_Result(AlertResult) : AjaxCall(data))


        });

        $('#password').on('keyup', function() {

            if ($(this).val() != '')
                $('#showpass').show();
            else
                $('#showpass').hide();
        });

        var show = true;

        $('#showpass').click(function() {
            if (show) {
                $('#password').attr('type', 'text');
                $(this).html('<i class="fas fa-eye-slash"></i>');
                show = false;
            } else {
                $('#password').attr('type', 'password');
                $(this).html('<i class="fas fa-eye"></i>');
                show = true;
            }

        });



    });


    function AjaxCall(data){

        post("<?= route_to('login'); ?>",data, function(res) {
            
            if(res.status == 200){

                window.location.href = "<?= route_to('Dashboard'); ?>";
            } 
            
            var AlertResult = {
                'tittle' : res.title,
                'icon'   : res.status == 200 ? 'success' : 'warning',
                'Message': res.Message
            };
            Message_Result(AlertResult)
        });

    }

</script>
