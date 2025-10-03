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
        <div id="icon_cont" style="position: relative; width: width: 92%; margin-top: 5px; margin-bottom: 15px;">
            <div id="icon" style="position: relative; width: 100px; margin:auto;">
                <img src="<?php echo base_url('assets/general/logo/12th_city_logo.png'); ?>" style="width:100px;" width="100">
            </div>
        </div>

        <div id="paymentContainer" style="max-width: 400px; height: auto; background-color: white; margin:auto; position: relative; padding:10px 0px 10px 0px; border-radius:20px; ">

            <!--Message -->
            <div style="position: relative; width: 80%; margin:auto; text-align: left; color: rgb(90,90,90); margin-top: 10px;">
                Name: <b style="color:rgb(40,40,40);"> Peter Griffin</b>
                <br>
                Email: <b style="color:rgb(40,40,40);"> Peter@gmail.com</b>
                <br>
                Phone: <b style="color:rgb(40,40,40);"> 08083321123</b>
            </div>

            <!--Body -->
            <div style="position: relative; width: 80%; margin:auto; text-align: left; font-size: 13px; margin-top: 20px;">
                <!-- <?= $message; ?> -->
                <b style="color:rgb(40,40,40);">Message: </b>
                I will open the whole matter, and explain the very things which were said by that discoverer of truth and, as it were, the architect of the happy life. Pain itself is loved, pursued, and desired to be obtained, but because times of that kind not infrequently occur that it seeks some great pleasure through toil and pain. But who can rightly blame either him who wishes to be in that pleasure which results in no discomfort, or him who avoids that pain which produces no pleasure?
            </div>

        </div>

        <div id="fooooo" style="width: 100%; text-align: center; margin-top: 20px; color: #494949; margin-bottom: 10px; ">
            <span>&copy;</span><?= date('Y'); ?> <?= business_name ?>. All rights reserved.
        </div>

    </div>

</body>

</html>