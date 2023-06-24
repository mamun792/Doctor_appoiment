@extends('layouts.profile_master')

@section('contents')

<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invoice View</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Invoice View</h2>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="invoice-content">
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-logo">
<h1>DLPCMS</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="invoice-details">

                                    <strong>Order:</strong> {{$invoice->relationInvoice->invoices_on}} <br>
                                    <strong>Issued:</strong> {{date('d F Y', strtotime($invoice->relationInvoice->created_at))}}
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-info">
                                    <strong class="customer-text">Invoice From</strong>
                                    <p class="invoice-details invoice-details-two">
                                        {{$invoice->relationInvoiceDoctor->fname}}   {{$invoice->relationInvoiceDoctor->lname}}<br>
                                        {{$invoice->relationInvoiceDoctor->hospital_address}}<br>
                                        {{$invoice->relationInvoiceDoctor->city}},  {{$invoice->relationInvoiceDoctor->locations}} <br>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-info invoice-info2">
                                    <strong class="customer-text">Invoice To</strong>
                                    <p class="invoice-details">
                                        {{$invoice->relationInvoiceList->name}} <br>
                                        {{$invoice->relationInvoiceList->phone_number}}, <br>
                                        {{$invoice->relationInvoiceList->email}} <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-info">
                                    <strong class="customer-text">Payment Method</strong>
                                    <p class="invoice-details invoice-details-two">
                                        Debit Card <br>
                                        XXXXXXXXXXXX-2541 <br>
                                        HDFC Bank<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="invoice-item invoice-table-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="invoice-table table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">VAT</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>General Consultation</td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">0</td>
                                                <td class="text-right">{{$invoice->relationInvoice->s_total}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 ml-auto">
                                <div class="table-responsive">
                                    <table class="invoice-table-two table">
                                        <tbody>
                                        <tr>
                                            <th>Subtotal:</th>
                                            <td><span>{{$invoice->relationInvoice->s_total}}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Discount:</th>
                                            <td><span>0%</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount:</th>
                                            <td><span>{{$invoice->relationInvoice->s_total}}</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>
            </div>
        </div>

    </div>

</div>

@endsection
