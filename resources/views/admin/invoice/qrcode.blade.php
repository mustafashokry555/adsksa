{{-- <!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة ضريبية</title>
    <style>
        body {
            font-family: "Tahoma", sans-serif;
            background: #f7f8fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            max-width: 400px;
        }
        .check-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #4CAF50;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
        }
        .check-icon::after {
            content: "✔";
            font-size: 40px;
            color: #4CAF50;
        }
        h2 {
            color: #1a237e;
            margin-bottom: 20px;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: right;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .label {
            color: #777;
            font-size: 14px;
        }
        .value {
            font-size: 14px;
            font-weight: bold;
        }
        .qr {
            margin-top: 20px;
            text-align: center;
        }
        .qr img {
            width: 120px;
            height: 120px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Check Icon -->
        <div class="check-icon"></div>

        <!-- Title -->
        <h2>فاتورة ضريبية صحيحة</h2>

        <!-- Card -->
        <div class="card">
            <div class="row">
                <span class="label">اسم المنشأة:</span>
                <span class="value">{{ $data['customer_name'] ?? 'XXXX' }}</span>
            </div>
            <div class="row">
                <span class="label">الرقم الضريبي:</span>
                <span class="value">{{ $data['vat_number'] ?? 'XXXX' }}</span>
            </div>
            <div class="row">
                <span class="label">تاريخ الفاتورة:</span>
                <span class="value">{{ $data['date'] ?? '' }}</span>
            </div>
            <div class="row">
                <span class="label">إجمالي الفاتورة (مع الضريبة):</span>
                <span class="value">{{ number_format($total, 2) }} ر.س</span>
            </div>
            <div class="row">
                <span class="label">ضريبة القيمة المضافة:</span>
                <span class="value">{{ number_format($total_vat, 2) }} ر.س</span>
            </div>

            <!-- QR Code -->
            {{-- <div class="qr">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($invoice->qr_data)) !!} " alt="QR Code">
            </div> --
        </div>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة ضريبية صحيحة</title>
    <style>
        body {
            font-family: 'Tahoma', Arial, sans-serif;
            background: #fff;
            text-align: center;
            direction: rtl;
            margin: 0;
            padding: 30px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            border: 3px solid #3bb54a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .success-icon::after {
            content: '✔';
            color: #3bb54a;
            font-size: 40px;
        }

        h2 {
            color: #1a1a1a;
            font-size: 26px;
            margin-bottom: 25px;
        }

        .invoice-card {
            width: 360px;
            margin: 0 auto;
            border: 1px solid #eee;
            border-radius: 20px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
            background: #fff;
            padding: 20px;
            text-align: right;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            font-size: 15px;
        }

        .label {
            color: #666;
        }

        .value {
            font-weight: bold;
            color: #000;
        }

        .highlight {
            color: #0056d2;
        }
    </style>
</head>
<body>

    <div class="success-icon"></div>
    <h2>فاتورة ضريبية صحيحة</h2>

    <div class="invoice-card">
        <div class="row">
            <span class="label">اسم المنشأة:</span>
            <span class="value highlight">{{ $data['customer_name'] ?? 'XXXX' }}</span>
        </div>
        <hr>
        <div class="row">
            <span class="label">الرقم الضريبي</span>
            <span class="value">{{ $data['vat_number'] ?? 'XXXX' }}</span>
        </div>
        <div class="row">
            <span class="label">تاريخ الفاتورة</span>
            <span class="value highlight">{{ $data['date'] ?? '20th May 2022 - 11:25PM' }}</span>
        </div>
        <div class="row">
            <span class="label">إجمالي الفاتورة (مع الضريبة)</span>
            <span class="value highlight">{{ number_format($total, 2) ?? '1150 ر.س' }}</span>
        </div>
        <div class="row">
            <span class="label">ضريبة القيمة المضافة</span>
            <span class="value">{{ number_format($total_vat, 2) ?? '150 ر.س' }}</span>
        </div>
    </div>

</body>
</html>

