<!DOCTYPE html>
<html>

<head>
    <title>PROCESSING YOUR PAYMENT REQUEST</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .page {
            height: 100%;
            width: 100%;
        }

        i {
            color: #fff;
            font-size: 140px !important;
        }

        .panel {
            position: absolute;
            max-width: 340px;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            border: 0;
        }

        .panel-body {
            padding: 40px;
            font-size: 18px;
            text-align: center;
            color: #666;
        }

        .panel-heading {
            border: 0;
            font-family: Montserrat;
            text-align: center;
            color: #fff;
            background: linear-gradient(270deg, #ff9327, #0066b3);
            background-size: 400% 400%;
            -webkit-animation: AnimationName 4s ease infinite;
            animation: AnimationName 4s ease infinite;
        }

        .panel-heading h2 {
            color: #fff;
            font-weight: 800;
            font-size: 19px;
            margin: 0 0 30px;
        }

        @-webkit-keyframes AnimationName {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes AnimationName {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .loader-outer {
            background-image: url("https://dl.dropboxusercontent.com/u/128401/live/fontis/binglee/binglee.svg");
            background-repeat: no-repeat;
            background-position: 50% 50%;
            background-size: 30px auto;
        }

        .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }

        .loader {
            margin: 40px auto 30px;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 0.4em solid rgba(255, 255, 255, 0.2);
            border-right: 0.5em solid rgba(255, 255, 255, 0.2);
            border-bottom: 0.4em solid rgba(255, 255, 255, 0.2);
            border-left: 0.5em solid #ffffff;
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }

        @-webkit-keyframes load8 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes load8 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>

<body>


    <div class="page">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="loader-outer">
                    <div class="loader"></div>
                </div>
                <h2>PROCESSING YOUR PAYMENT REQUEST</h2>
            </div>
            <div class="panel-body">
                <p>Hold tight, your order is being processed, please do not navigate away from the current
                    window or refresh the page.</p>
            </div>
        </div>
    </div>


    <form action="{{ $data['action'] }}" method="post" id="paymentForm">
        <input type="hidden" value="{{ $data['user_code'] }}" name="user_code">
        <input type="hidden" value="{{ $data['pass_code'] }}" name="pass_code">
        <input type="hidden" value="{{ $data['tran_id'] }}" name="tran_id">
        <input type="hidden" value="{{ $data['amount'] }}" name="amount">
        <input type="hidden" value="{{ $data['charge_code'] }}" name="charge_code">
        <input type="hidden" value="{{ $data['hash_value'] }}" name="hash_value">
        <input type="hidden" value="{{ $data['returnUrl'] }}" name="reserve10">
        <input type="hidden" value="{{ $data['erp_code'] }}" name="reserve1">
    </form>


    <script>
        window.onload = function() {
            document.getElementById('paymentForm').submit();
        }
    </script>

</body>

</html>
