<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Order Received</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('vendor/bower_components/bootstrap/dist/css/bootstrap.min.css')  }}" rel="stylesheet" type="text/css" />
    <style>

        th {
            padding: 5px;
        }

        tr {
            padding: 5%;
        }
    </style>
</head>
<body>
    <h1 style="color:white;background:#FE4C50;padding:4%;" class="text-center">PREVIS DISCOUNT CLUB</h1>

    <p>Hello {{ $user->fullname() }},</p> <br>
    <p>Kindly Find your Order details Below:</p><br>
    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Your Orderr</div>

    <!-- Table -->
    <table class="table">
    <thead>
                        <tr>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Unit price</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($orderItems as $id => $item)
                        <tr class="text-center">
                          <td><a href="#">{{ $item['options']['name'] }}</a></td>
                          <td>{{ $item['qty'] }}</td>
                          <td>₦{{ $item['price'] }}.00</td>
                          <td>₦{{ $item['qty'] * $item['price'] }}.00</td>
                        </tr>
                    @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="5">Total</th>
                          <th>₦{{ $totalAmount }}</th>
                        </tr>
                      </tfoot>
                    </table>
    </table>
</div>

<h5>We'll notify when your order is ready. Thanks for your Patronage.</h5>
</body>
</html>