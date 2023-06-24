@extends('layouts.dashboard_master')
@section('contant')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Transactions</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transactions</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">



                    <div class="table-responsive">
                        <table id="tranjection_id" class="display " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Patient ID</th>
                                    <th>Patient Name</th>
                                    <th>Total Amount</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice_detiles as $invoices)
                                @if ($invoices->relationInvoiceDoctor && $invoices->relationInvoiceDoctor->vendor_id == auth()->user()->id)
                                    <tr>
                                        <td><a href="invoice.html">{{ $invoices->relationInvoice->invoices_on }}</td>
                                        <td>{{ $invoices->relationInvoiceList->p_id }}</td>

                                        <td>
                                            <a href="profile.html" class="avatar avatar-sm mr-2">
                                                @if ($invoices->relationInvoiceList->profile_photo)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('uploads/profile_photo/') }}/{{ $invoices->relationInvoiceList->profile_photo }}"
                                                        width="50" alt="user">
                                                @else
                                                    <img class="rounded-circle"
                                                        src="{{ Avatar::create($invoices->relationInvoiceList->name)->toBase64() }}"
                                                        width="45" alt="{{ $invoices->relationInvoiceList->name }}">
                                                @endif
                                            </a>
                                            <a href="profile.html">
                                                {{ $invoices->relationInvoiceList->name }}
                                            </a>
                                        </td>

                                        <td>
                                            {{ $invoices->relationInvoice->s_total }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-pill bg-success inv-badge">
                                                {{ $invoices->relationInvoice->payment_status }}
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="actions">
                                                <button value="{{ route('admin.tranjection.delete', $invoices->id) }}"
                                                    class="btn btn-sm btn-danger speical_sweetalert">
                                                    <i class="fe fe-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                            @if (count($invoice_detiles) === 0)
                                <tr>
                                    <td colspan="6" class="text-center">No data found.</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scprit')
    <script>
        $(document).ready(function() {
        $('#tranjection_id').DataTable();
        $('#tranjection_id').on('click', '.speical_sweetalert', function() {

            var link = $(this).val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            })
        });

        });

    </script>
@endsection
