<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Order Received</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1 style="color:white;background:#FE4C50;padding:4%;" class="text-center">PREVIS DISCOUNT CLUB</h1>

    <p>You have a new Order from <strong>{{ $userfullname }}.</strong> </p>

    <ul>
    @foreach($orderItems as $id => $item)
        <li>Item: <strong>{{ $item['options']['name'] }}</strong></li>
        <li>Quantity: <strong>{{ $item['qty'] }}</strong></li> <br><br>
    @endforeach
    </ul>

</div>
</body>
</html>