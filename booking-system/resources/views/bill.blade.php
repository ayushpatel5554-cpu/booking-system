<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill #{{ $booking->choli_name ?? 'N/A' }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Define Brand Colors */
        :root {
            --brand-color: #2575fc;
            --secondary-color: #6a11cb;
            --light-bg: #f4f7ff;
        }

        @page { margin: 10mm; } 
        body {
            /* Using DejaVu Sans for reliable PDF rendering of symbols */
            font-family: DejaVu Sans, "Segoe UI", Arial, sans-serif;
            font-size: 11px; /* Slightly reduced font size for space */
            color: #333;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        /* NEW HEADER STRUCTURE */
        .page-header {
            border-bottom: 2px solid var(--brand-color);
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        /* Utility table for the absolute top line */
        .utility-header {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            color: #555;
            margin-bottom: 5px;
        }

        /* COMPANY INFO (Address, Phone, Name) */
        .company-info {
            width: 100%;
            border-collapse: collapse;
        }

        .company-info .address-block {
            font-size: 11px;
            text-align: right;
            line-height: 1.4;
            color: #555;
        }
        
        .company-info .contact-block {
            font-size: 12px;
            font-weight: bold;
            color: var(--secondary-color);
        }

        /* TAGLINE */
        .tagline {
            width: 100%;
            background: var(--light-bg);
            border-left: 4px solid var(--brand-color);
            margin-top: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
            color: #333;
        }
        .tagline table { width: 100%; }

        /* BILL DETAILS (Rest of styles maintained) */
        .bill-details {
            background: #fdfdfd;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 6px 8px;
            margin-top: 10px;
            width: 100%;
        }

        .bill-details td {
            font-size: 12px;
            padding: 3px 6px;
        }

        /* ITEM TABLE */
.item-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    border: 1px solid #d0e0fb; /* Lighter outer border */
    border-radius: 8px; /* Slightly rounded corners for the table */
    overflow: hidden; /* Ensures rounded corners are visible */
}

.item-table thead th {
    background: linear-gradient(90deg, var(--brand-color), var(--secondary-color)); /* Gradient header */
    color: #fff;
    font-weight: 600; /* Slightly bolder */
    padding: 8px 10px; /* More padding */
    text-align: center;
    font-size: 12px;
    border: none; /* Remove internal borders for header cells */
    border-bottom: 1px solid #fff; /* A subtle white line below header */
}

.item-table tbody td {
    border: 1px solid #e0e0e0; /* Lighter internal borders */
    padding: 7px 10px; /* Consistent padding */
    text-align: center;
    font-size: 11px; /* Slightly smaller for content */
    color: #444;
}

/* Specific column alignments for readability */
.item-table tbody td:nth-child(1) { text-align: center; } 
.item-table tbody td:nth-child(2) { text-align: left; } 
.item-table tbody td:nth-child(3) { text-align: center; } 
.item-table tbody td:nth-child(4),
.item-table tbody td:nth-child(5),
.item-table tbody td:nth-child(6) { text-align: right; } 

.item-table tbody tr:nth-child(even) {
    background: #f7f9fc;
}
.item-table tbody td:nth-child(6) {
    background-color: var(--light-bg); 
    font-weight: bold;
    color: var(--brand-color); 
}

.item-table tbody tr:nth-child(even) td:nth-child(6) {
    background-color: #e9efff; 
}

.currency {
    font-family: DejaVu Sans, sans-serif; 
}
/* ITEM TABLE */
.item-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    border: 1px solid #d0e0fb;
    border-radius: 8px;
    overflow: hidden; 
}

.item-table thead th {
    background: var(--brand-color);
    color: black;
    font-weight: 600;
    padding: 8px 10px;
    text-align: center;
    font-size: 12px;
    border: none;
    border-bottom: 2px solid #fff;
}
.green{
    color: green;
    font: bold;
}
.red{
    color: red;
    font: bold;
}
    </style>
</head>
<body>
<div class="invoice-container">
    
    <table class="utility-header">
        <tr>
            <td style="text-align:right;">Bill/Receipt</td>
        </tr>
    </table>

    <div class="page-header">
        <table class="company-info">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <h1 style="color:var(--brand-color); margin: 0; font-size: 22px;">
                        Chundari Designer Studio
                    </h1>
                    <div style="font-size: 10px; color: #777; margin-top: 2px;">
                        Choli Rental & Custom Design Experts
                    </div>
                </td>
                
                <td style="width: 50%; text-align: right; vertical-align: top;">
                    <div class="address-block">
                        A-62, Purvi Society, Street No. 8, Varachha Road,<br>
                        Near Anandnagar, Hirabaug, Surat.<br>
                    </div>
                    <div class="contact-block">
                         +91 98243 62522 (Sumitaben) <br>
                         +91 70481 65958 (Harshbhai)
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="tagline">
        <table width="100%">
            <tr>
                <td style="text-align:left;">**YOUR CHOICE IS CHUNDARI DIGITAL STUDIO**</td>
                <td style="text-align:right;">Choli available on rent or made on order.</td>
            </tr>
        </table>
    </div>

    <table class="bill-details">
        <tr>
            <td><strong>Name:</strong></td>
            <td style="border-bottom:1px dashed #aaa; font-family: 'cursive', sans-serif; font-style: italic;">
    {{ $booking->customer_name ?? '' }}
</td>
            <td style="text-align:right;"><strong>Bill No.:</strong></td>
            <td style="color:var(--brand-color); font-size:16px; font-weight:bold;">{{ $booking->bill_no ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Mobile No.:</strong></td>
            <td style="border-bottom:1px dashed #aaa;">{{ $booking->contact_number ?? '' }}</td>
            <td style="text-align:right;"><strong>Date:</strong></td>
            <td style="border-bottom:1px dashed #aaa;">{{ $booking->created_at ? $booking->created_at->format('d-m-Y') : '' }}</td>
        </tr>
    </table>

    <table class="item-table">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 35%;">Details</th>
                <th style="width: 10%;">Choli No.</th>
                <th style="width: 15%;">Rent (₹)</th>
                <th style="width: 15%;">Deposit (₹)</th>
                <th style="width: 20%;">Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
        @php $rendered = 0; @endphp
        @if(isset($booking->items) && $booking->items->count())
            @foreach($booking->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="text-align:left;">{{ $booking->choli_name }}</td>
                    <td>{{ $booking->choli_no ?? '' }}</td>
                    <td style="text-align:right;">{{ number_format($item->rent_per_unit ?? $booking->rent_price, 2) }}</td>
                    <td style="text-align:right;">{{ number_format($booking->deposit_price ?? 0, 2) }}</td>
                    <td style="text-align:right;">{{ number_format($item->total_rent_amount ?? $booking->rent_price, 2) }}</td>
                </tr>
                @php $rendered++; @endphp
            @endforeach
        @else
            <tr>
                <td>1</td>
                <td style="text-align:left;">{{ $booking->choli_name ?? 'Choli Rental' }}</td>
                <td>{{ $booking->choli_no ?? 'N/A' }}</td>
                <td style="text-align:right;">{{ number_format($booking->rent_price ?? 0, 2) }}</td>
                <td style="text-align:right;">{{ number_format($booking->deposit_price ?? 0, 2) }}</td>
                <td style="text-align:right;">{{ number_format(($booking->rent_price ?? 0) + ($booking->deposit_price ?? 0), 2) }}</td>
            </tr>
            @php $rendered = 1; @endphp
        @endif
        @for ($i = $rendered; $i < 5; $i++)
            <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td></tr>
        @endfor
        </tbody>
    </table>

        <div style="width:100%; overflow:auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top; padding: 0;">
                        <table class="date-table" style="width: 100%; margin-top: 15px;">
                            <tr class="green">
                                <td class="label" style="width: 40%;">Delivery Date</td>
                                <td style="width: 60%;">{{ $booking->delivery_date ? \Carbon\Carbon::parse($booking->delivery_date)->format('d-m-Y') : '-' }}</td>
                            </tr>
                            <tr class="red">
                                <td class="label">Return Date</td>
                                <td>{{ $booking->return_date ? \Carbon\Carbon::parse($booking->return_date)->format('d-m-Y') : '-' }}</td>
                            </tr>
                        </table>
                    </td>

                    <td style="width: 50%; vertical-align: top; padding: 0;">
                        <table class="summary-total" style="width: 300px; margin-left: auto; margin-top: 15px;">
                            <tr>
                                <td class="label">Total Amount</td>
                                <td style="text-align:right;">{{ number_format($booking->total_amount ?? $booking->rent_price, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="label">Paid</td>
                                <td style="text-align:right;">{{ number_format($booking->amount_paid ?? 0, 2) }}</td>
                            </tr>
                            <tr class="highlight">
                                <td>Due</td>
                                <td style="text-align:right;">{{ number_format($booking->due_amount ?? (($booking->total_amount ?? $booking->rent_price) - ($booking->amount_paid ?? 0)), 2) }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>


    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width:65%;">
                    <strong>Note:</strong>
                    <ul class="note">
                        <li>Advance payment is non-refundable.</li>
                        <li>Customer is responsible for damage or loss.</li>
                        <li>Full rent must be paid at pickup; bill required on return.</li>
                    </ul>
                </td>
                <td class="signature left-20">
                    For,<br><strong>Chundari Designer Studio</strong>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>