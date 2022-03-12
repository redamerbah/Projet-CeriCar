
<div id="LoginSection">
    <div class="limiter">
        <div class="container-login100 " >
            <div class="wrap-login100">
                <div class="login100-form-title">
                        <span class="login100-form-title-1">
                            Log In
                        </span>
                </div>

                <form id="login" class="login100-form validate-form" method="post">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="identifiant" id="identifiant" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" id="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="btn btn-dark" style="font-size: 20px;font-weight: 600;font-family: 'Trebuchet MS', serif" >Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script >
    $(document).ready(function(){
    $('#login').submit(function(){

             var data = $(this).serialize();
                  $.ajax({
                   url : 'ajaxDispatcher.php?action=login',
                   data: $(this).serialize(),
                   type : 'GET',
                   success : function(html, statut){ 
                   
                           $.get('ajaxDispatcher.php?action=header',function(data){
                               $("#header").html(data);    
                           });
                        $.get('ajaxDispatcher.php?action=rechercheVoyage',function(data){
                            $("#page_maincontent").html(data);
                           
                        });

                   }
                   });


             return false;
         })
});

</script> 