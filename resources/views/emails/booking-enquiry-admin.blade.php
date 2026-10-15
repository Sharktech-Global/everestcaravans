
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Vehicle Booking Enquiry</title>
</head>
<body style="margin:0;padding:0;background:#f2f5f9;font-family:Arial,Helvetica,sans-serif;color:#222;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2f5f9;">
    <tr>
        <td align="center" style="padding:30px 12px;">

            <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                   style="max-width:600px;width:100%;background:#ffffff;">

                <!-- Header -->
                <tr>
                    <td align="center" style="background:#092d59;padding:30px 25px;">
                        <h2 style="margin:0;color:#ffffff;font-size:22px;">
                            EVEREST CARAVANS
                        </h2>
                        <p style="margin:12px 0 0;color:#ffffff;font-size:14px;">
                            New Vehicle Booking Enquiry
                        </p>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="padding:30px 25px;">

                        <p style="font-size:14px;line-height:24px;">
                            Hello Everest Caravans Team,
                        </p>

                        <p style="font-size:14px;line-height:24px;margin-bottom:25px;">
                            A new vehicle booking enquiry has been submitted through the website.
                        </p>

                        @php
                            $fields = [
                                'Vehicle' => $details['vehicle_name'] ?? null,
                                'Full Name' => $details['name'] ?? null,
                                'Email' => $details['email'] ?? null,
                                'Phone' => $details['phone'] ?? null,
                                'Suburb' => $details['suburb'] ?? null,
                                'State' => $details['state'] ?? null,
                                'Postcode' => $details['postcode'] ?? null,
                                'Additional Details' => $details['additional_details'] ?? null,
                            ];
                        @endphp

                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                               style="border-collapse:collapse;font-size:14px;">

                            @foreach($fields as $label => $value)
                                <tr>
                                    <td width="42%" valign="top"
                                        style="padding:20px 10px;border-bottom:1px solid #ddd;font-weight:bold;line-height:22px;">
                                        {{ $label }}
                                    </td>

                                    <td width="58%" valign="top"
                                        style="padding:20px 10px;border-bottom:1px solid #ddd;line-height:22px;word-break:break-word;">

                                        @if($label === 'Email' && filled($value))
                                            <a href="mailto:{{ $value }}" style="color:#0066cc;">
                                                {{ $value }}
                                            </a>
                                        @elseif($label === 'Phone' && filled($value))
                                            <a href="tel:{{ $value }}" style="color:#0066cc;">
                                                {{ $value }}
                                            </a>
                                        @else
                                            {!! nl2br(e(filled($value) ? $value : 'Not provided')) !!}
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </table>

                        <p style="font-size:14px;line-height:24px;margin:30px 0 0;">
                            Please contact the customer to discuss their vehicle booking enquiry.
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td align="center" style="background:#edf2f7;padding:18px;color:#555;font-size:12px;">
                        Everest Caravans | Vehicle Booking Enquiry
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
