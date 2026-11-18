<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Warrior Landing Page Enquiry</title>
</head>
<body style="margin:0;padding:0;background:#f2f5f9;font-family:Arial,sans-serif;color:#222;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2f5f9;">
        <tr>
            <td align="center" style="padding:30px 12px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;">
                    <tr>
                        <td style="background:#092d59;color:#ffffff;padding:30px 25px;text-align:center;">
                            <h2 style="margin:0;font-size:22px;color:#ffffff;">EVEREST CARAVANS</h2>
                            <p style="margin:12px 0 0;font-size:14px;color:#ffffff;">New Warrior Landing Page Enquiry</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px 25px;">
                            <p style="font-size:14px;line-height:24px;">Hello Everest Caravans Team,</p>
                            <p style="font-size:14px;line-height:24px;margin-bottom:25px;">
                                A new Warrior caravan enquiry has been submitted.
                                Please review the customer's preferences and contact details below.
                            </p>
                            @php
                                $fields = [
                                    'Full Name' => $details['name'] ?? null,
                                    'Email' => $details['email'] ?? null,
                                    'Phone Number' => $details['phone'] ?? null,
                                    'WhatsApp Number' => $details['whatsapp_number'] ?? null,
                                    'Post Code' => $details['postcode'] ?? null,
                                    'Which Caravan Interests You?' => $details['preferred_model'] ?? null,
                                    'What Would You Like To Do Next?' => $details['next_action'] ?? ($details['enquiry_type'] ?? null),
                                    'When Are You Considering Purchasing?' => $details['purchase_timeframe'] ?? null,
                                    'Where Are You Based?' => $details['location'] ?? null,
                                    'Submitted From' => $details['source_url'] ?? null,
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
                                            style="padding:20px 10px;border-bottom:1px solid #dddddd;line-height:22px;">
                                            {{ $value ?: '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f2f5f9;padding:20px 25px;text-align:center;font-size:12px;color:#666;">
                            Sent automatically from the Warrior landing page at everestcaravans.com.au
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
