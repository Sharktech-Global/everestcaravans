<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Factory Visit Enquiry</title>
</head>
<body style="font-family:Arial,sans-serif;color:#333;">

    <h2>New Factory Visit Enquiry</h2>

    <p>A customer has submitted a factory visit request.</p>

    <table cellpadding="10" cellspacing="0"
           border="1"
           style="border-collapse:collapse;width:100%;max-width:650px;">

        @foreach ([
            'Name' => $details['name'],
            'Email' => $details['email'],
            'Phone' => $details['phone'],
            'Preferred Date' => $details['visit_date'],
            'Preferred Time' => $details['visit_time'],
            'Suburb' => $details['suburb'],
            'State' => $details['state'],
            'Postcode' => $details['postcode'],
            'Caravan Type' => $details['vehicle_name'],
            'Additional Requirements' => $details['additional_requirements'] ?? null,
        ] as $label => $value)

            <tr>
                <th style="text-align:left;background:#f5f5f5;">
                    {{ $label }}
                </th>
                <td>
                    {{ filled($value) ? $value : 'Not provided' }}
                </td>
            </tr>

        @endforeach

    </table>

    <p>Please contact the customer to confirm the requested visit.</p>

</body>
</html>
