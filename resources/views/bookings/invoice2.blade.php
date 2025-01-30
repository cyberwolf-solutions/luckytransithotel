@extends('layouts.master-without-nav')

@section('title')
    Invoice
@endsection

@section('content')
    <style>
        body {
            background-color: #FFF !important;
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
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
    </style>

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
               
                    <tr>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $data->room_no }}</td>
                        <td>{{ $data->room_type }}</td>
                        <td>{{ $data->checkin }}</td>
                        <td>{{ $data->checkout }}</td>
                        {{-- <td>{{ number_format($row->unit_price, 2) }}</td> --}}
                        <td>{{ number_format($data->total_amount, 2) }}</td>
                    </tr>
             
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
          
                <table class="table w-50">
                    <tr>
                        <td class="summary" style="background-color: #E96E43">Subtotal</td>
                        {{-- <td>{{ $settings->currency }} {{ number_format($subtotal, 2) }}</td> --}}

                        {{-- <td>{{ number_format($data->total_amount, 2) }}</td> --}}
                        <td>{{ number_format($data->total_amount, 2) }}</td>


                        {{-- <td>100</td> --}}
                    </tr>
                    <tr>
                        <td class="summary" style="background-color: #E96E43">Sales Tax</td>
                        {{-- <td>{{ $settings->currency }} {{ number_format($tax, 2) }}</td> --}}
                        <td>{{ number_format($data->discount, 2) }}</td>

                        {{-- <td>{{ number_format($data->paid_amount, 2) }}</td> --}}

                    </tr>
                    <tr class="border-top" style="background-color:#002147;color:#FFF">
                        <td class="summary">TOTAL</td>
                        {{-- <td><strong>{{ $settings->currency }} {{ number_format($total, 2) }}</strong></td> --}}
                        <td>{{ number_format($data->total_amount, 2) }}</td>


                        {{-- <td>{{ number_format($data->paid_amount, 2) }}</td> --}}

                    </tr>
                </table>
           
        </div>

        <div class="mt-4">
            <span>Signature: ___________________</span>
            <span class="float-end">Date: ________________</span>
        </div>

        <div class="row" style="background-color:#E96E43;margin-top:30px">
            <div class="col-12" style="text-align: center">
                <span style="color: #FFF">Lucky Transit Hotel, 660/8 Araliya m.w, Katunayake 11450</span>
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
