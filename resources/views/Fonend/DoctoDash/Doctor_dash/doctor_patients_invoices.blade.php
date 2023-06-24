@extends('layouts.doctor_master')

@section('contents')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="invoice-content">
                        @foreach ($invoice_id as $invoice_ids)
                            <div class="invoice-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="invoice-logo">
                                            {{-- <img src="assets/img/logo.png" alt="logo"> --}}
                                            <h1 class="text-primary">DLPCMS</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="invoice-details">

                                            <strong>Order: </strong> {{ $invoice_ids->relationInvoice->invoices_on }} <br>
                                            <strong>Issued: </strong>{{ $invoice_ids->created_at }}

                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Invoice Item -->



                        <div class="invoice-item">
                            <div class="row">
                                @foreach ($doctor_info as $doctor_infos)
                                    <div class="col-md-6">
                                        <div class="invoice-info">
                                            <strong class="customer-text">Invoice From</strong>
                                            <p class="invoice-details invoice-details-two">
                                                {{ $doctor_infos->fname }} {{ $doctor_infos->lname }} <br>
                                                {{ $doctor_infos->hospital_address }} <br>

                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-6">
                                    @if ($patient_con == '0')
                                        @foreach ($patient_reg_det as $patient_reg_dets)
                                            <div class="invoice-info invoice-info2">
                                                <strong class="customer-text">Invoice To</strong>
                                                <p class="invoice-details">{{ $patient_reg_dets->name }}
                                                    <br>
                                                    {{ $patient_reg_dets->email }} <br>
                                                    {{ $patient_reg_dets->phone_number }}
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($patient_detieal as $patient_detieals)
                                            <div class="invoice-info invoice-info2">
                                                <strong class="customer-text">Invoice To</strong>
                                                <p class="invoice-details">{{ $patient_detieals->fname }}
                                                    {{ $patient_detieals->lname }}
                                                    <br>
                                                    {{ $patient_detieals->adderss }}, <br>
                                                    {{ $patient_detieals->division }},{{ $patient_detieals->country }}
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- /Invoice Item -->

                        <!-- Invoice Item -->
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
                        <!-- /Invoice Item -->

                        <!-- Invoice Item -->
                        <div class="invoice-item invoice-table-wrap">
                            <div class="row">
                                @foreach ($invoice_id as $invoice_ids)
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="invoice-table table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        {{-- <th class="text-center">Quantity</th> --}}
                                                        <th class="text-center">VAT</th>
                                                        <th class="text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>General Consultation</td>
                                                        {{-- <td class="text-center">1</td> --}}
                                                        <td class="text-center">00</td>
                                                        <td class="text-right">{{ $invoice_ids->relationInvoice->s_total }}
                                                        </td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <td>Video Call Booking</td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-center">$0</td>
                                                        <td class="text-right">$250</td>
                                                    </tr> --}}
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
                                                        <td><span>{{ $invoice_ids->relationInvoice->s_total }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount:</th>
                                                        <td><span>-0%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount:</th>
                                                        <td><span>{{ $invoice_ids->relationInvoice->s_total }}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>


                        <!-- Invoice Information -->
                        <div class="other-info">
                            @foreach ($patient_detieal as $patient_detieals)
                                <h4>Other information</h4>
                                <p class="text-muted mb-0">
                                    {{ $patient_detieals->about }}
                                </p>
                            @endforeach
                        </div>
                        <!-- /Invoice Information -->

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
