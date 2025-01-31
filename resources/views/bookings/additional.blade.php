@extends('layouts.master-without-nav')

@section('title')
    Print Order
@endsection

@section('content')
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        @media print {
            body {
                zoom: 0.85;
            }
        }

        .invoice-container {
            width: 100%;
            height: 297mm;
            position: relative;
            margin: auto;
            padding: 20px;
            max-width: 800px;
        }

        body {
            background-color: #FFF !important;
            font-family: Arial, sans-serif;
        }

        .a4-container {
            width: 100%;
            height: 297mm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
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

        .summary {
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

        .contact-info span {
            display: block;
        }

        .invoice-footer {
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
        }

    </style>
    <div class="a4-container">
        <div class="invoice-container">

            <div class="row" style="margin-top: 50px">
                <div class="col-6">
                    <div class="contact-info mb-3">
                        <div class="row">
                            <div class="col-12" style="font-size: 30px; font-weight: bold; text-align: left">
                                INVOICE
                            </div>
                            <div class="col-12" style="margin-top: 30px">
                                <h5 class="fw-bold">Bill to</h5>
                                <hr style="border: 1px solid black;">
                            </div>

                            <div class="col-12">
                                <span><b>📞</b> {{ $checkinCheckout->customer->contact ?? 'Walking Customer' }}</span>
                                <span><b>📧</b> {{ $checkinCheckout->customer->email ?? 'N/A' }}</span>
                                <span><b>🌍</b> {{ $checkinCheckout->customer->address ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="text-center mb-4">
                        <img src="{{ URL::asset('build/images/logonew.png') }}" style="height: 200px;width:auto" class="invoice-header img-fluid" alt="" height="100">
                        <p>{{ $settings->address }}</p>
                    </div>
                </div>
            </div>

            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Room No</th>
                        <th>Order Item</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Item Price</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalRows = 10;
                        $rowCount = 0;
                        $subtotal = 0;
                    @endphp
                
                    @foreach ($orders as $order)
                        @foreach ($order->items as $item)
                            @if ($rowCount >= $totalRows)
                                @break
                            @endif
                            <tr>
                                <td>{{ $order->room_id }}</td>
                                <td>{{ $item->meal->name }}</td>
                                <td>1 * {{ $item->quantity }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $settings->currency }} {{ number_format($item->price, 2) }}</td>
                                <td>{{ $settings->currency }} {{ number_format($item->total, 2) }}</td>
                                @php
                                    $subtotal += $item->total;
                                    $rowCount++;
                                @endphp
                            </tr>
                        @endforeach
                        @if ($rowCount >= $totalRows)
                            @break
                        @endif
                    @endforeach
                
                    @for ($i = $rowCount; $i < $totalRows; $i++)
                        <tr>
                            <td>&nbsp;</td>
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
                            <td>{{ $settings->currency }} {{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr class="border-top" style="background-color: #002147; color: #FFF">
                            <td class="summary">TOTAL</td>
                            <td>{{ $settings->currency }} {{ number_format($subtotal, 2) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-4">
                    <span>Signature: ___________________</span>
                    <span class="float-end">Date: ________________</span>
                </div>

                <div class="row" style="background-color:#E96E43; margin-top:30px">
                    <div class="col-12 text-center">
                        <span style="color: #FFF">Thimbiri Wewa Resort, 660/8 Araliya m.w, Katunayake 11450</span>
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
