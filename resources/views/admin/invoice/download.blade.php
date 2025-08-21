<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة ضريبية مبسطة</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 12px;
        }

        .invoice-container {
            width: 320px;
            margin: 0 auto;
            background: white;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .header {
            text-align: center;
            padding: 10px;
            border-bottom: 2px solid #4CAF50;
        }

        .header h1 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .invoice-number {
            /* background: #4CAF50; */
            color: Black;
            padding: 3px 8px;
            font-size: 10px;
            display: inline-block;
            margin-top: 5px;
        }

        .customer-info {
            padding: 10px;
            border-bottom: 1px solid #4CAF50;
            font-size: 11px;
        }

        .date-section {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #4CAF50;
            font-size: 11px;
        }

        .tax-number {
            text-align: center;
            padding: 5px;
            font-size: 10px;
            border-bottom: 1px solid #4CAF50;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
            font-size: 10px;
        }

        .items-table th {
            background: #f8f8f8;
        }

        .totals-section {
            padding: 10px;
            border-top: 1px solid #4CAF50;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 11px;
        }

        .final-total {
            font-weight: bold;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }

        .qr-section {
            text-align: center;
            padding: 15px;
            border-top: 2px dashed #ccc;
        }

        .footer-text {
            font-size: 9px;
            margin-bottom: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="invoice-container" id="invoice">
        <!-- Header -->
        <div class="header">
            <h1>فاتورة ضريبية مبسطة</h1>
            <div class="invoice-number" dir="ltr">{{ $data['invoice_number'] }} :رقم الفاتورة</div>
        </div>

        <!-- Customer Info -->
        <div class="customer-info">
            <div>اسم المشتري: {{ $data['customer_name'] }}</div>
            <div>عنوان المشتري: {{ $data['customer_address'] }}</div>
        </div>

        <!-- Date -->
        <div class="date-section">
            التاريخ: {{ $data['date'] }}
        </div>

        <!-- Tax Number -->
        <div class="tax-number">
            الرقم الضريبي لمقدم الخدمة: {{ $data['vat_number'] }}
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>البيان</th>
                    <th>الكمية</th>
                    <th>سعر الوحدة</th>
                    <th>قيمة الضريبة</th>
                    <th>الإجمالي</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                    $total_vat = 0;
                @endphp
                @foreach ($data['items'] as $item)
                    @php
                        $total_raw = $item['price'] * $item['quantity'];
                        $vat_raw = $total_raw * 0.15;
                        $total += $total_raw;
                        $total_vat += $vat_raw;
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 2) }}</td>
                        <td>{{ number_format($vat_raw, 2) }}</td>
                        <td>{{ number_format($total_raw + $vat_raw, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <div class="total-row">
                <span>إجمالي المبلغ الخاضع للضريبة</span>
                <span>{{ number_format($total, 2) }}</span>
            </div>
            <div class="total-row">
                <span>ضريبة القيمة المضافة (%15)</span>
                <span>{{ number_format($total_vat, 2) }}</span>
            </div>
            <div class="total-row final-total">
                <span>المجموع الإجمالي</span>
                <span>{{ number_format($total + $total_vat, 2) }}</span>
            </div>
        </div>

        <!-- QR Code Section -->
        <div class="qr-section">
            <div class="footer-text" dir="ltr">
                ({{ $data['invoice_number'] }}) الفاتورة الضريبية المبسطة
            </div>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" width="120" height="120">
        </div>
    </div>

    {{-- <script>
    // Auto trigger download on page load
    window.onload = function() {
        window.location.href = "{{ url('invoices/123/download') }}";
    }
</script> --}}
    {{-- <script>
        window.onload = function() {
            window.print();
        };
    </script> --}}
{{-- html2canvas --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> --}}

{{-- jsPDF --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    window.onload = function () {
        const { jsPDF } = window.jspdf;

        html2canvas(document.getElementById("invoice"), { scale: 1 }).then(canvas => {
            const imgData = canvas.toDataURL("image/png");
            const pdf = new jsPDF("p", "mm", "a3");

            // Calculate width/height to fit A4
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            pdf.addImage(imgData, "PNG", 100, 0, 100, 200);
            pdf.save("invoice.pdf");
        });
    }
</script> --}}
</body>
</html>
