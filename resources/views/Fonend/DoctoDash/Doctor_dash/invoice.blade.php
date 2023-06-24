<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
            top: 0px;
            right: 0;
        }

        .heading {
            color: #0071DC;
            font-weight: bold;
            font-size: 34px;
        }

        .divFlex {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .bold {
            font-weight: bold;
        }

        .fontSize {
            font-size: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 4px;
            margin-bottom: 30px;
            padding: 30px;
        }

        .textColor {
            color: #757575;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;

        }
    </style>
</head>

<body>
    <div class="card">
        <div class="relative">
            <h1 class="heading">DLPCMS</h1>
            <div class="absolute">
                @foreach ($invoices_download as $invoice)
                    <p><span class="bold" style="font-size: 18px;">Issued: </span><span
                            class="textColor">{{ $invoice->created_at->format('Y F d') }}</span></p>
                    <p><span class="bold" style="font-size: 18px;">Order: </span><span
                            class="textColor">{{ $invoice->relationInvoice->invoices_on }}</span></p>
                @endforeach
            </div>
        </div>
        @foreach ($invoices_download as $invoices_downloads)
            <div class="relative">
                <div>
                    <h1 class="bold" style="font-size: 24px;">Invoice From</h1>
                    <p class="textColor">{{ $invoices_downloads->relationInvoiceDoctor->fname }}
                        {{ $invoices_downloads->relationInvoiceDoctor->lname }}</p>
                    <p class="textColor">{{ $invoices_downloads->relationInvoiceDoctor->hospital_address }}</p>
                    <p class="textColor">{{ $invoices_downloads->relationInvoiceDoctor->locations }}</p>
                </div>


                <div class="absolute" style="display: flex; flex-direction: column; align-items: flex-end;">
                    <h1 class="bold">Invoice To</h1>
                    <p class="textColor">{{ $invoices_downloads->relationInvoiceList->name }}</p>
                    <p class="textColor">
                        @if ($invoices_downloads->relationInvoiceList && $invoices_downloads->relationInvoiceList->relationWithProfiledetial && $invoices_downloads->relationInvoiceList->relationWithProfiledetial->adderss)

                       {{$invoices_downloads->relationInvoiceList->relationWithProfiledetial->adderss}}
                    @else
                        <p>{{ $invoices_downloads->relationInvoiceList->email }}</p>
    @endif
                    </p>
                    <p class="textColor">
                        @if ($invoices_downloads->relationInvoiceList && $invoices_downloads->relationInvoiceList->relationWithProfiledetial && $invoices_downloads->relationInvoiceList->relationWithProfiledetial->adderss)

                        {{$invoices_downloads->relationInvoiceList->relationWithProfiledetial->country}}
                     @else
                         <p>{{ $invoices_downloads->relationInvoiceList->phone_number }}</p>
     @endif

                </div>
            </div>
        @endforeach
        <div>
            <h1 class="bold">Payment Method</h1>
            <p class="textColor">Debit Card</p>
            <p class="textColor">XXXXXXXXXXXX-2541</p>
            <p class="textColor">HDFC Bank</p>
        </div>

        <!-- table -->
        <table id="customers">
            @foreach ($invoices_download as $invoices_downloads)
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>VAT</th>
                    <th>Total</th>
                </tr>

                <tr class="textColor">
                    <td>General Consultation</td>
                    <td>1</td>
                    <td>50</td>
                    <td>{{ $invoices_downloads->relationInvoice->s_total }}</td>
                </tr>
            @endforeach
        </table>

        <div style="float: right;">
            <p class="fontSize"><span class="bold" style="margin-right: 25px;">Subtotal: </span><span
                    class="textColor">{{ $invoices_downloads->relationInvoice->s_total }}</span></p>
            <p class="fontSize"><span class="bold">Discount: </span><span class="textColor">0%</span></p>
            <p class="fontSize"><span class="bold">Total Amount: </span><span
                    class="textColor">{{ $invoices_downloads->relationInvoice->s_total + 50 }}</span></p>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div style="bottom: 50px;">
            <h2 class="bold">Other information</h2>
            <p class="textColor">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Vivamus
                sed dictum ligula, cursus blandit risus. Maecenas eget
                metus non
                tellus dignissim aliquam ut a ex. Maecenas sed vehicula
                dui, ac
                suscipit lacus. Sed finibus leo vitae lorem interdum, eu
                scelerisque tellus fermentum. Curabitur sit amet lacinia
                lorem.
                Nullam finibus pellentesque libero.</p>
        </div>
    </div>
</body>

</html>
