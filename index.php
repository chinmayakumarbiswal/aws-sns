<?php
require './vendor/autoload.php';

$params = array(
    'credentials' => array(
        'key' => '-- Your IAM User Key --',
        'secret' => '-- Your IAM User Key Secret --',
    ),
    'region' => 'ap-south-1', // < your aws from SNS Topic region
    'version' => 'latest'
);
$sns = new \Aws\Sns\SnsClient($params);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQS Message</title>

    <style>
    .contact-form {
        margin-top: 15px;
    }

    .contact-form .textarea {
        min-height: 220px;
        resize: none;
    }

    .form-control {
        box-shadow: none;
        border-color: #eee;
        height: 49px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #00b09c;
    }

    .form-control-feedback {
        line-height: 50px;
    }

    .main-btn {
        background: #00b09c;
        border-color: #00b09c;
        color: #fff;
    }

    .main-btn:hover {
        background: #00a491;
        color: #fff;
    }

    .form-control-feedback {
        line-height: 50px;
        top: 0;
    }
    </style>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet"
        href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" />
    <script type="text/javascript"
        src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js">
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <form role="form" id="contact-form" class="contact-form" action="#" method="post">
                <div class="row">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control textarea" rows="3" name="Messagename" id="Message"
                                    placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <input type="submit" class="btn main-btn pull-right" value="Send Message" name="sendm"
                                required />
                        </div>
                    </div>
            </form>


            <?php

                        if(isset($_POST['sendm']))
                        {
                            $mymessage = $_POST['Messagename'];
                            $args = array(
                                "MessageAttributes" => [
                                            'AWS.SNS.SMS.SMSType' => [
                                                'DataType' => 'String',
                                                'StringValue' => 'Transactional'
                                            ]
                                        ],
                                "Message" => $mymessage,
                                "PhoneNumber" => "+916370******"
                                //your phone no
                            );
                            
                            
                            $result = $sns->publish($args);
                            
                            var_dump($result);
                            
                        }
                ?>
        </div>
    </div>
</body>
</html>
