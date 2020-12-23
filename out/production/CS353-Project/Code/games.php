<?php
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIST - Sign Up</title>
    <link rel="stylesheet" type="text/css" id="applicationStylesheet" href="../Assets/css/index.css"/>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script id="applicationScript" type="text/javascript" src="index.js"></script>
</head>
<body style="font-family: Avenir !important;">
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" style="font-weight: bold; font-size: xx-large; font-family: Avenir">MIST</a>
        <div class="navbar-nav">
            <a href="developerhome.php" class="nav-item nav-link">Home</a>
            <a class="nav-item nav-link active">Games</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="main-div" style="padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
        <div class="information-header" style="width: 100%">
            <div style="font-family: Avenir; font-size: 48px;  margin-bottom: 2%">Games</div>
            <hr>
        </div>
        <div class="games-body" style="margin-right: 30%; ">
            <div class="create-game-row" style="display: flex; height: 300px">
                <div class="create-game-image" onclick="checkEmptyAndLogin()" style="width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;">
                    <div style="display: table-cell; vertical-align: middle"> + </div>
                </div>
                <div class="create-game-description" style="display: table; overflow: hidden; width: 50%; height: 100%;">
                    <div style="display: table-cell; vertical-align: middle; padding-left: 50px;">
                        <span style="font-weight: bold">Description: </span>
                        <span>Create a new game.</span>
                    </div>
                </div>
            </div>
            <div style="margin: 50px"></div>
            <div class="games-row" style="display: flex; height: 300px">
                <div class="game-image" style="width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;">
                    <div style="display: table-cell; vertical-align: middle"> + </div>
                </div>
                <div class="game-description" style="display: table; overflow: hidden; width: 50%; height: 100%;">
                    <div style="display: table-cell; vertical-align: middle; padding-left: 50px;">
                        <div>
                            <span style="font-weight: bold">Name: </span>
                            <span>Whoever Us</span>
                        </div>
                        <div>
                            <span style="font-weight: bold">Description:> </span>
                            <span> HERE IS LONG DESC HERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESC </span>
                        </div>
                        <div>
                            <span style="font-weight: bold">Downloaded: </span>
                            <span>25K</span>
                        </div>
                        <div>
                            <span style="font-weight: bold">Rate: </span>
                            <span>3 / 5</span>
                        </div>
                        <br>
                        <div>
                            <button type="button" class="btn btn-primary" class='btn btn-primary btn-lg' style='font-family: Avenir; width: 50%; background-color: rgb(234, 124, 137); border-color: rgb(234, 124, 137); border-radius: 20px' data-toggle="modal" data-target="#exampleModalCenter">
                                Update
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog-centered" role="main" style="height: 400px; width: 800px;">
                                    <div class="modal-content" style="height: 400px; width: 800px">
                                        <div class="modal-body">
                                            <div style="background-color: white; height: 350px; width: 600px; border-radius: 30px; border-color: rgba(112,112,112,1); border-style: solid;">
                                                <div style="text-align: center; font-size: 24px; margin-top: 2px;">
                                                    Update Game
                                                </div>
                                                <div style="align-items: center; text-align: center;">
                                                    <form id="login-form" method="post">
                                                        <div class="input-group" style="width:  margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                                                            <input id="game-version" type="text" class="form-control" name="game-version" placeholder="New Game Version">
                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                                                            <input id="game-description" type="text" class="form-control" name="game-description" placeholder="Description">
                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                            </div>
                                                            <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                            </div>
                                                            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                            </div>
                                                            <input id="phone-number" type="text" class="form-control" name="phone-number" placeholder="Phone Number">
                                                        </div>
                                                        <div class="form-group" style="margin-top: 5%;">
                                                            <input onclick="checkEmptyAndLogin()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Sign Up  ">
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
            </div>
        </div>
    </div>
    <div style="
                width: 100%;
                text-align: center;
                font-size: 20px;
                color: rgba(112,112,112,1);">
        <p>A Game Distribution Service by Pluto++</p>
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script type="text/javascript">
    function checkEmptyAndLogin() {
        let fullNameVal = document.getElementById("full-name").value;
        let nickNameVal = document.getElementById("nick-name").value;
        let emailVal = document.getElementById("email").value;
        let passwordVal = document.getElementById("password").value;
        let phoneNumberVal = document.getElementById("phone-number").value;
        if (fullNameVal === "" || passwordVal === "" || nickNameVal === "" || emailVal === "" | phoneNumberVal === "") {
            alert("Make sure to fill all fields!");
        }
        else {
            let form = document.getElementById("login-form").submit();
        }
    }
</script>
</body>
</html>


