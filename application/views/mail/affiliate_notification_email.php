<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        * {

            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: "Montserrat", sans-serif;
            font-size: 13px;

        }
    </style>
</head>

<body>
    <!--styling the container-->
    <div id="container" style="width: 100%; height: auto; padding: 10px 10px 10px 10px; background-color:rgb(240, 240, 240); position: relative; border-radius:5px; ">

        <!--Logo-->
        <div id="icon_cont" style="position: relative; width: 92%; margin-top: 5px; margin-bottom: 15px;">
            <div id="icon" style="position: relative; width: 100px; margin:auto;">
                <img src="<?php echo production_url('assets/general/logo/12th_city_logo.png'); ?>" style="width:100px;" width="100">
            </div>
        </div>

        <div id="paymentContainer" style="max-width: 400px; height: auto; background-color: white; margin:auto; position: relative; padding:10px 0px 10px 0px; border-radius:20px; ">

            <!--Message -->
            <div style="position: relative; width: 80%; margin:auto; text-align: left; color: rgb(90,90,90); margin-top: 10px; margin-bottom: 30px;">
                <p> Name: <b style="color:rgb(40,40,40);"> <?= $name; ?></b></p>
                <br>
                <br>
                <p>Phone (WhatsApp): <b style="color:rgb(40,40,40);"> <?= $phone; ?></b></p>
                <br>
                <br>
                <p> Email: <b style="color:rgb(40,40,40);"> <?= $email; ?></b></p>
                <br>
                <br>
                <p> Address: <b style="color:rgb(40,40,40);"> <?= $address; ?></b></p>
            </div>

        </div>

        <div id="fooooo" style="width: 100%; text-align: center; margin-top: 20px; color: #494949; margin-bottom: 10px; ">
            <span>&copy;</span><?= date('Y'); ?> <?= business_name ?>. All rights reserved.
        </div>

    </div>

</body>

</html>