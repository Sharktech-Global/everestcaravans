<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thank You - Everest Caravans</title>
</head>

<body style="margin:0;padding:30px 12px;background:#f2f5f9;font-family:Arial,sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                    style="max-width:600px;width:100%;background:#fff;">
                    <tr>
                        <td style="background:#092d59;color:#fff;padding:25px;text-align:center;">
                            <h2 style="margin:0;">EVEREST CARAVANS</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;color:#243447;line-height:1.7;">
                            <h2>Thank You for Your Factory Visit Request</h2>
                            <p>Dear {{ $details['name'] }},</p>
                            <p>Thank you for your interest in visiting the Everest Caravans factory.</p>
                            <p>We have received your request with the following details:</p>
                            
                            <p><strong>Preferred Date:</strong> {{ $details['visit_date'] }}</p>
                            <p><strong>Preferred Time:</strong> {{ $details['visit_time'] }}</p>
                            <p><strong>Caravan Type:</strong> {{ $details['vehicle_name'] }}</p>
                            
                            <p>Please note that your factory visit is not confirmed until you receive confirmation from our team.</p>

                            <p>Kind regards,<br><strong>Everest Caravans Team</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#edf2f7;padding:18px;text-align:center;color:#555;">
                            Everest Caravans
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>