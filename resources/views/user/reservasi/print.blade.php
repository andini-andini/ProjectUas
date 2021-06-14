<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Resi Pemesanan Kamar Hotel</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 5px;
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
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
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

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h4>HOTEL<span style="color: #cda45e">LY</span></h4>
                                {{-- <img src="{{asset('img/not.png')}}" style="width: 100%; max-width: 300px" /> --}}
                            </td>

                            <td>
                                Invoice: #{{$data->code}}<br />
                                Created: {{ date("d.m.Y", strtotime($data->check_in))}}<br />
                                Due: {{ date("d.m.Y", strtotime($data->check_out))}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{$data->user->name}}<br />
                                {{$data->user->address}}<br />
                                {{$data->user->phone}}
                            </td>

                            <td>
                                Customer Service<br />
                                Amelia Widya Andini<br />
                                cs.hotelly@gmail.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            {{-- <tr class="heading">
                <td>Payment Method</td>

                <td>Check #</td>
            </tr> --}}

            {{-- <tr class="details">
                <td>Check</td>

                <td>1000</td>
            </tr> --}}

            <tr class="heading">
                <td>Item</td>

                <td>Keterangan</td>
            </tr>

            <tr class="item">
                <td>{{$data->kamar->name}}</td>
                <td>Rp {{ number_format($data->kamar->price, 0, ',', '.')}}</td>
            </tr>

            <tr class="item">
                <td>Check In</td>
                <td>{{ date("d.m.Y", strtotime($data->check_in))}}</td>
            </tr>
            <tr class="item">
                <td>Check Out</td>
                <td>{{ date("d.m.Y", strtotime($data->check_out))}}</td>
            </tr>
            <tr class="item">
                <td>Days</td>
                <td>{{ $dataPrice['days'] }} malam</td>
            </tr>
            <tr class="item">
                <td>Guest</td>
                <td>{{ $data->guest }} orang</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Total: Rp {{ number_format($dataPrice['totalPrice'], 0, ',', '.')}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
