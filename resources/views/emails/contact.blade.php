
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Enquiry</title>
</head>
<body style="margin:0;padding:30px 12px;background:#f2f5f9;font-family:Arial,sans-serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0">
<tr><td align="center">
<table role="presentation" width="600" cellpadding="0" cellspacing="0"
       style="max-width:600px;width:100%;background:#fff;">
    <tr>
        <td style="background:#092d59;color:#fff;padding:25px;text-align:center;">
            <h2 style="margin:0;">EVEREST CARAVANS</h2>
            <p style="margin:10px 0 0;">New Contact Enquiry</p>
        </td>
    </tr>
    <tr>
        <td style="padding:25px;">
            <p>Hello Everest Caravans Team,</p>
            <p>A new enquiry has been submitted through the website.</p>

            @php
                $fields = [
                    'Full Name' => $details['name'] ?? '',
                    'Email' => $details['email'] ?? '',
                    'Phone' => $details['phone'] ?? '',
                    'Suburb' => $details['suburb'] ?? '',
                    'State' => $details['state'] ?? '',
                    'Preferred Caravan Type' => $details['vehicle_name'] ?? '',
                    'Message' => $details['message'] ?? '',
                ];
            @endphp

            <table role="presentation" width="100%" cellpadding="10"
                   cellspacing="0" style="border-collapse:collapse;">
                @foreach($fields as $label => $value)
                    <tr>
                        <td style="border-bottom:1px solid #ddd;width:40%;font-weight:bold;">
                            {{ $label }}
                        </td>
                        <td style="border-bottom:1px solid #ddd;white-space:pre-wrap;">
                            {{ $value !== '' && $value !== null ? $value : 'Not provided' }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
    <tr>
        <td style="background:#edf2f7;padding:18px;text-align:center;color:#555;">
            Everest Caravans | Website Contact Enquiry
        </td>
    </tr>
</table>
</td></tr>
</table>

</body>
</html>
