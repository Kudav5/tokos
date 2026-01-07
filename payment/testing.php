<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Payment</title>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="YOUR_CLIENT_KEY"></script>
</head>
<body>

<button id="pay-button">Pay!</button>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        // SnapToken acquired from previous step
        var snapToken = '<?php echo $snapToken; ?>';
        snap.pay(snapToken, {
            onSuccess: function(result){
                console.log('success');
                console.log(result);
            },
            onPending: function(result){
                console.log('pending');
                console.log(result);
            },
            onError: function(result){
                console.log('error');
                console.log(result);
            },
            onClose: function(){
                console.log('customer closed the popup without finishing the payment');
            }
        });
    };
</script>

</body>
</html>
