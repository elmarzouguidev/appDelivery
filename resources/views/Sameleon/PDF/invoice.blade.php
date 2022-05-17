<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ optional($invoice->client)->full_name }} - {{ $invoice->invoice_date->format('d-m-Y') }}</title>
    <style>
        @page {
            margin: 60px 25px;
        }

        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 5px;
            margin-bottom: 5px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 2px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 15px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
        }

        .invoice-box table tr td:nth-child(3) {
            text-align: left;
        }

        .invoice-box table tr td:nth-child(4) {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 2px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.heading-price td {
            background: #eee;
            /*border-bottom: 2px solid #325288;*/
            font-weight: bold;
            text-align: right;
        }

        .invoice-box table tr.details td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .bott {
            height: 0px;
            width: 200px;
            border-bottom: solid #1572A1 20px;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        footer {
            position: fixed;
            bottom: -10px;
            left: 0px;
            right: 0px;
            height: 50px;
            /** Extra personal styles **/

            color: white;
            text-align: center;
            line-height: 10px;
        }

    </style>
</head>

<body>


    <footer>

        <div style="text-align: center; color:#333; font-size: 11px !important;">
            <p>{{ optional(getCompany())->name }}</p>
            <p>
                {{ optional(getCompany())->addresse }}
                Tél : {{ optional(getCompany())->telephone }}
                E-mail : {{ optional(getCompany())->email }}
            </p>
            <p>
                -R.C:{{ optional(getCompany())->rc }}
                -PATENTE:{{ optional(getCompany())->patente }}
                -I.F:{{ optional(getCompany())->if }}
                @if(isset(getCompany()->cnss))
                -CNSS:{{ optional(getCompany())->cnss }}
                @endif
                -ICE:{{ optional(getCompany())->ice }}
            </p>
        </div>
        <div class="bott" style=" width: 100%;">
        </div>

    </footer>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title" style="text-align: left;">
                                <img src="{{ $companyLogo }}" style="height: 100px" />
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td style="width: 50% ;">
                                <strong>Client : {{ optional($invoice->client)->full_name }}</strong> <br />
                                @if(optional($invoice->client)->type == 'particulier')
                                 CNIE : {{ strtoupper(optional($invoice->client)->cnie) }}<br />
                                @endif
                                @if(optional($invoice->client)->type == 'entreprise' && optional($invoice->client)->company)
                                 ICE : {{ optional($invoice->client->company)->ice }}<br />
                                @endif
                                @if(optional($invoice->client)->type == 'entreprise' && optional($invoice->client)->company)
                                 Adresse : {{ optional($invoice->client->company)->addresse }} <br />
                                @else
                                 Adresse : {{ optional($invoice->client)->addresse }} <br />
                                @endif

                            </td>
                            <td style="width: 50% ; text-align: right; !important">
                                <strong>FACTURE N° : {{ $invoice->code }}</strong><br />
                                Date : {{ $invoice->invoice_date->format('d-m-Y') }}<br />
                                {{-- Date d'échéance : {{ $estimate->due_date }} --}}
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>

            {{-- <tr class="heading">
            <td colspan="4">Réferences client</td>

        </tr>
        <tr class="details">
            <td colspan="4">
                BL : {{ $invoice->bl_code }}

                BC : {{ $invoice->bc_code }}
            </td>
        </tr> --}}

            <tr class="heading">
                <td>Code d'envoi</td>
                <td>Date livraison</td>
                <td>Ville</td>
                <td>Etat</td>
                <td>Prix</td>
                <td>Frais</td>
            </tr>

            @foreach ($invoice->articles as $article)
         
                @php
                 $color = '';
                 optional($article->command)->status == App\Status\Status::REFUSE ? $color = 'red':''
                @endphp
                <tr class="item {{ $loop->last ? 'last' : '' }}" style="color:{{$color}} !important">
                    <td style="width: 30% ;">{{ $article->code_command }}</td>
                    @if(optional($article->command)->status != App\Status\Status::LIVRE)
                     <td>{{ optional($article->command)->updated_at->format('d-m-Y') ?? '' }}</td>
                    @else
                     <td>{{ optional($article->command)->delivered_at->format('d-m-Y') ?? '' }}</td>
                    @endif
                    <td>{{ $article->city }}</td>
                    <td>{{ __('status.statuses.' . $article->command->status) }}</td>
                    @if(optional($article->command)->status == App\Status\Status::REFUSE)
                    <td>----</td>
                    @else
                    <td>{{$article->formated_price_total}}</td>
                    @endif
                    <td>{{ number_format($article->frais,2) }} DH</td>
                </tr>

            @endforeach
            
            <div class="pricer">
                <tr class="heading-price lefter">
                    <td colspan="6">Montant BRUT : {{ number_format($invoice->formated_total_brut,2)}} DH</td>
                </tr>
                <tr class="heading-price lefter">
                    @php
                     $frais = $invoice->articles->sum('frais')
                    @endphp
                    <td colspan="6">Frais : {{ number_format($frais,2) }} DH</td>
                </tr>
                <tr class="heading-price lefter">
                    @php 
                        if($invoice->formated_total_brut == 0 || $frais > $invoice->formated_total_brut)
                        {
                            $net = 00;
                        }
                        else{
                            $net = $invoice->formated_total_brut - $frais;
                        }
        
                    @endphp
                    <td colspan="6">Montant NET : {{ number_format($net,2) }} DH</td>
                </tr>
            </div>

        </table>

    </div>

    @if (isset($invoice->condition_general))
        <div style="text-align: left;font-size: 12px;color:black">
            <p>Condition général</p>
            <p>{{ $invoice->condition_general }}</p>
        </div>
    @endif


    <script type="text/php">

        if (isset($pdf) && $PAGE_COUNT > 1) {
            $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
            $size = 5;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width);
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }


</script>
</body>

</html>
