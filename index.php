<?php
require_once "includes/db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
</head>
<body>

<!-- Page Content -->
<div class="form-gap"></div>
<div class="container">
    <div class="col-md-12 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">


                    <h3><i class="fa fa-user fa-4x"></i></h3>
                    <h2 class="text-center">Login</h2>
                    <div class="panel-body">


                        <form id="login-form" action="loginproc.php" name="login_form" role="form" autocomplete="off"
                              class="form" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

                                    <input name="username" type="text" class="form-control"
                                           placeholder="Insert username">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                    <input name="password" type="password" class="form-control"
                                           placeholder="Insert password">
                                </div>
                            </div>

                            <div class="form-group">

                                <input name="login" class="btn btn-lg btn-primary btn-block" value="Submit"
                                       type="submit">
                            </div>


                        </form>

                    </div><!-- Body-->

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<hr>

</div> <!-- /.container -->
</body>
</html>