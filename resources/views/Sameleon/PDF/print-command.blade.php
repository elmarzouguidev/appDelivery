<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $command->code }} - {{ $command->created_at->format('d-m-Y') }}</title>
    <style>
        body {
            font-size: 18px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td {
            padding: 0;
        }

        table tr td:last-child {
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .large {
            font-size: 18px;
        }

        .total {
            font-weight: bold;
            color: #1a0c0d;
        }

        .logo-container {
            margin: 10px 0 10px 0;
        }

        .invoice-info-container {
            font-size: 16px;
        }

        .invoice-info-container td {
            padding: 4px 0;
        }

        .client-name {
            font-size: 16px;
            vertical-align: top;
        }

        .line-items-container {
            margin: 70px 0;
            font-size: 16px;
        }

        .line-items-container th {
            text-align: left;
            color: rgb(19, 14, 14);
            border-bottom: 2px solid #ddd;
            padding: 10px 0 15px 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .line-items-container th:last-child {
            text-align: left;
        }

        .line-items-container td {
            padding: 15px 0;
        }

        .line-items-container tbody tr:first-child td {
            padding-top: 25px;
        }

        .line-items-container.has-bottom-border tbody tr:last-child td {
            padding-bottom: 25px;
            border-bottom: 2px solid #ddd;
        }

        .line-items-container.has-bottom-border {
            margin-bottom: 0;
        }

        .line-items-container th.heading-quantity {
            width: 50px;
        }

        .line-items-container th.heading-price {
            text-align: right;
            width: 100px;
        }

        .line-items-container th.heading-subtotal {
            width: 100px;
        }

        .payment-info {
            width: 38%;
            font-size: 16px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 100px;
        }

        .footer-thanks {
            font-size: 1.125em;
        }

        .footer-thanks img {
            display: inline-block;
            position: relative;
            top: 1px;
            width: 16px;
            margin-right: 4px;
        }

        .footer-info {
            float: right;
            margin-top: 5px;
            font-size: 0.75em;
            color: #ccc;
        }

        .footer-info span {
            padding: 0 5px;
            color: black;
        }

        .footer-info span:last-child {
            padding-right: 0;
        }

        .page-container {
            display: none;
        }
    </style>
</head>

<body>
    <div class="page-container">
        Page
        <span class="page"></span>
        of
        <span class="pages"></span>
    </div>

    <div class="logo-container">
        <img style="height: 100px" src="{{ $companyLogo }}">
    </div>

    <table class="line-items-container has-bottom-border">
        <thead>
            <tr>
                <th>Destinataire</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="payment-info">
                    <div>
                        Nom complet :<strong>{{ $command->client_name }}</strong>
                    </div>
                    <div>
                        Téléphone :<strong>{{ $command->client_phone }}</strong>
                    </div>
                    <div>
                        Adresse :<strong>{{ $command->client_address }}</strong>
                    </div>
                    <div>
                        Ville :<strong>{{ $command->city->name }}</strong>
                    </div>
                </td>

        </tbody>
    </table>
    <table class="line-items-container has-bottom-border">
        <thead>
            <tr>
                <th>Command</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($command->items as $item)
                <tr>
                    <td class="payment-info">
                        <div>
                            Produit : <strong>{{$item->product}}</strong>
                        </div>
                        <div>
                            Prix  : 
                            <strong>
                                {{ $item->prix_uni }} (DH) 
                                    x
                                {{ $item->quantity }}
                            </strong>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="footer">
        <div class="footer-info">
            <span>info@sameleon-express.ma</span> |
            <span>555 444 6666</span> |
            <span>sameleon-express.ma</span>
        </div>
        <div class="footer-thanks">
            <img src="https://github.com/anvilco/html-pdf-invoice-template/raw/main/img/heart.png" alt="heart">
            <span>Thank you!</span>
        </div>
    </div>
</body>

</html>
