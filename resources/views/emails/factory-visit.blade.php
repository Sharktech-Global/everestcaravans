<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Factory Visit Enquiry</title>
</head>
<body style="margin:0;padding:0;background:#f2f5f9;font-family:Arial,sans-serif;color:#222;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2f5f9;">
        <tr>
            <td align="center" style="padding:30px 12px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;">
                    <tr>
                        <td style="background:#092d59;color:#ffffff;padding:30px 25px;text-align:center;">
                            <h2 style="margin:0;font-size:22px;color:#ffffff;">EVEREST CARAVANS</h2>
                            <p style="margin:12px 0 0;font-size:14px;color:#ffffff;">New Factory Visit Enquiry</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px 25px;">
                            <p style="font-size:14px;line-height:24px;">Hello Everest Caravans Team,</p>
                            <p style="font-size:14px;line-height:24px;margin-bottom:25px;">A customer has submitted a factory visit request.</p>
                            @php
                                $fields = [
                                    'Full Name' => $details['name'] ?? null,
                                    'Email' => $details['email'] ?? null,
                                    'Phone' => $details['phone'] ?? null,
                                    'Preferred Date' => $details['visit_date'] ?? null,
                                    'Preferred Time' => $details['visit_time'] ?? null,
                                    'Suburb' => $details['suburb'] ?? null,
                                    'State' => $details['state'] ?? null,
                                    'Postcode' => $details['postcode'] ?? null,
                                    'Caravan Type' => $details['vehicle_name'] ?? null,
                                    'Additional Requirements' => $details['additional_requirements'] ?? null,
                                ];
                            @endphp
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                style="border-collapse:collapse;font-size:14px;">
                                @foreach($fields as $label => $value)
                                    <tr>
                                        <td width="42%" valign="top"
                                            style="padding:20px 10px;border-bottom:1px solid #dddddd;font-weight:bold;line-height:22px;">
                                            {{ $label }}
                                        </td>
                                        <td width="58%" valign="top"
                                            style="padding:20px 10px;border-bottom:1px solid #dddddd;line-height:22px;word-break:break-word;">
                                            @if($label === 'Email' && filled($value))
                                                <a href="mailto:{{ $value }}" style="color:#0066cc;">
                                                    {{ $value }}
                                                </a>
                                            @elseif($label === 'Phone' && filled($value))
                                                <a href="tel:{{ $value }}" style="color:#0066cc;">
                                                    {{ $value }}
                                                </a>
                                            @else
                                                {{ filled($value) ? $value : 'Not provided' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <p style="font-size:14px;line-height:24px;margin:30px 0 0;">
                                Please contact the customer to confirm the requested visit.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#edf2f7;padding:18px;text-align:center;color:#555;font-size:12px;">
                            Everest Caravans | Factory Visit Enquiry
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>