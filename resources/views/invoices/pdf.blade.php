<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $invoice->invoice_id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 14px;
        }

        .container {
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
        }

        .muted {
            color: #6b7280;
        }

        .box {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            color: #059669;
        }

        .status {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: bold;
          
        }

        .Paid { background: #d1fae5; color: #065f46; }
        .Pending { background: #fef3c7; color: #92400e; }
        .Overdue { background: #fee2e2; color: #991b1b; }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
<div class="container">

    {{-- Header --}}
    <div class="header">
        <div>
            <div class="title">Invoice</div>
            <div class="muted">{{ $invoice->invoice_id }}</div>
        </div>

        <div style="text-align:right">
            <div class="muted">Invoice Date</div>
            <strong>{{ optional($invoice->invoice_date)->format('Y-m-d') }}</strong>
        </div>
    </div>

    {{-- Client --}}
    <div class="box">
        <div class="muted">Billed To</div>
        <strong>{{ $invoice->client->name }}</strong>
    </div>

    {{-- Details --}}
    <div class="box">
        <div class="row">
            <span class="muted">Status</span>
            <span class="status {{ $invoice->status }}">
                {{ $invoice->status }}
            </span>
        </div>

        <div class="row">
            <span class="muted">Amount</span>
            <strong>${{ number_format($invoice->amount, 2) }}</strong>
        </div>
    </div>

    {{-- Total --}}
    <div class="box">
        <div class="row">
            <span>Total</span>
            <span class="total">
                ${{ number_format($invoice->amount, 2) }}
            </span>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        Generated on {{ now()->format('Y-m-d') }} by SmartBiz
    </div>

</div>
</body>
</html>
