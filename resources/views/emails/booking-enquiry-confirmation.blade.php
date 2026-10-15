
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Enquiry Confirmation</title>
</head>
<body style="margin:0;padding:0;background:#f2f5f9;font-family:Arial,Helvetica,sans-serif;color:#222;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2f5f9;">
        <tr>
            <td align="center" style="padding:30px 12px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                    style="max-width:600px;width:100%;background:#ffffff;">
                    <tr>
                        <td align="center" style="background:#092d59;padding:30px 25px;">
                            <h2 style="margin:0;color:#ffffff;font-size:22px;">
                                EVEREST CARAVANS
                            </h2>
                            <p style="margin:12px 0 0;color:#ffffff;font-size:14px;">Booking Enquiry Confirmation</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:35px 25px;">
                            <p style="font-size:14px;line-height:24px;">Dear {{ $details['name'] ?? 'Customer' }},</p>
                            <p style="font-size:14px;line-height:24px;">Thank you for your interest in Everest Caravans.</p>
                            <p style="font-size:14px;line-height:24px;">We have successfully received your vehicle booking enquiry.Our team will review your request and contact you as soon as possible.</p>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                style="margin:25px 0;border-collapse:collapse;background:#f5f7fa;">
                                <tr>
                                    <td style="padding:20px;border-left:4px solid #092d59;">
                                        <p style="font-size:12px;color:#666;margin:0 0 8px;">
                                            VEHICLE ENQUIRY
                                        </p>
                                        <h3 style="font-size:18px;color:#092d59;margin:0;">
                                            {{ $details['vehicle_name'] ?? 'Everest Caravan' }}
                                        </h3>
                                    </td>
                                </tr>
                            </table>
                            <p style="font-size:14px;line-height:24px;">
                                If you have any additional questions, please feel free to contact our team.
                            </p>
                            <p style="font-size:14px;line-height:24px;margin-top:30px;">
                                Best regards,<br>
                                <strong>Everest Caravans Team</strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="background:#edf2f7;padding:18px;color:#555;font-size:12px;">
                            Thank you for choosing Everest Caravans.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
