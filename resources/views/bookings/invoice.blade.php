@extends('layouts.master-without-nav')

@section('title')
    Invoice
@endsection

@section('content')
    <style>
        @page {
            size: A4;
            margin: 20mm;
            /* Adjust margins */
        }

        @media print {
            body {
                zoom: 0.85;
                /* Shrinks the content slightly */
            }
        }


        .invoice-container {
            width: 100%;
            height: 297mm;
            /* A4 height */
            position: relative;
            margin: auto;
            padding: 20px;
            max-width: 800px;
        }

        body {
            background-color: #FFF !important;
            font-family: Arial, sans-serif;
        }

        /* .invoice-container {
                                                        max-width: 800px;
                                                        margin: auto;
                                                        padding: 20px;
                                                        border: 1px solid #ddd;
                                                    } */
        .a4-container {
            width: 100%;
            height: 297mm;
            /* Exact A4 height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Push footer to the bottom */
            position: relative;
            overflow: hidden;
            /* Prevent overflow */
        }


        .invoice-footer,
        .summary-table,
        .signature-section {
            page-break-inside: avoid;
        }


        .invoice-footer {
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
        }



        .invoice-header img {
            width: 120px;
        }

        .invoice-title {
            font-size: 2rem;
            font-weight: bold;
            color: #002147;
        }

        .table thead th {
            background-color: #002147;
            color: #fff;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .table tfoot td {
            font-weight: bold;
        }

        .border-top {
            border-top: 2px solid #dee2e6;
        }

        .fw-bold {
            font-weight: bold;
        }

        .contact-info span {
            display: block;
        }

        .summary {
            /* background-color: orange; */
            padding: 10px;
            font-weight: bold;
        }

        .footer {
            position: relative;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #E96E43;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
    <div class="a4-container">
        <div class="invoice-container">

            <div class="row" style="margin-top: 50px">
                <div class="col-6">
                    <div class="contact-info mb-3">

                        <div class="row">
                            <div class="col-12" style="font-size: 30px;font-weight:bold;text-align:left">
                                INVOICE
                            </div>
                            <div class="col-12" style="margin-top: 30px">
                                <h5 class="fw-bold">Bill to</h5>
                                <hr style="border: 1px solid black;">

                            </div>

                            <div class="col-12">
                                <span><b>📞</b> 0112 260 227</span>
                                <span><b>📧</b> info@luckytransithotel.com</span>
                                <span><b>🌍</b> www.luckytransithotel.com</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-6">
                    <div class="text-center mb-4">
                        {{-- <img src="{{ asset('images/logonew.png') }}" class="invoice-header img-fluid" alt="Logo"> --}}
                        <img src="{{ URL::asset('build/images/logonew.png') }}" class="invoice-header img-fluid"
                            style="height: 200px;width:auto" alt="" height="22">

                        {{-- <div class="row">
                        <div class="col-12">
                            <div class="invoice-title" style="color: #E96E43;font-size:50px">Lucky</div>
                        </div>
                        <div class="col-12">
                            <div class="invoice-title" style="margin-top: -10px">Transit Hotel</div>
                        </div>
                    </div> --}}
                        <p>{{ $settings->address }}</p>
                    </div>
                </div>
            </div>






            {{-- <p>
            @if ($data1->customer_id == 0)
                Walking Customer
            @else
                {{ $data1->customer->name }}<br>
                {{ $data1->customer->contact }}<br>
                {{ $data1->customer->email }}<br>
                {{ $data1->customer->address }}
            @endif
        </p> --}}

            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Room no.</th>
                        <th>Room type</th>
                        <th>Checking</th>
                        <th>Checkout</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalRows = 10; 
                        $rowCount = count($data); 
                    @endphp

                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->room_no }}</td>
                            <td>{{ $row->room_type }}</td>
                            <td>{{ $row->checkin }}</td>
                            <td>{{ $row->checkout }}</td>
                            <td>{{ number_format($row->total_amount, 2) }}</td>
                        </tr>
                    @endforeach

                    @for ($i = $rowCount; $i < $totalRows; $i++)
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endfor
                </tbody>


            </table>

            <div class="invoice-footer">
                <div class="d-flex justify-content-end">
                    <table class="table w-50">
                        <tr>
                            <td class="summary" style="background-color: #E96E43">Subtotal</td>
                            <td>{{ number_format($row->total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="summary" style="background-color: #E96E43">Sales Tax</td>
                            <td>{{ number_format($row->discount, 2) }}</td>
                        </tr>
                        <tr class="border-top" style="background-color:#002147;color:#FFF">
                            <td class="summary">TOTAL</td>
                            <td>{{ number_format($row->total_amount, 2) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-4">
                    <span>Signature: ___________________</span>
                    <span class="float-end">Date: ________________</span>
                </div>

                <div class="row" style="background-color:#E96E43;margin-top:30px">
                    <div class="col-12 text-center">
                        <span style="color: #FFF">Lucky Transit Hotel, 660/8 Araliya m.w, Katunayake 11450</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endsection
