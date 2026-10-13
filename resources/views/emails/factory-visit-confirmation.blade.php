<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factory Visit Request Received</title>
</head>
<body style="font-family:Arial,sans-serif;color:#333;">

    <h2>Thank You for Your Factory Visit Request</h2>

    <p>Dear {{ $details['name'] }},</p>

    <p>
        Thank you for your interest in visiting the
        Everest Caravans factory.
    </p>

    <p>
        We have received your request with the following details:
    </p>

    <p>
        <strong>Preferred Date:</strong>
        {{ $details['visit_date'] }}
    </p>

    <p>
        <strong>Preferred Time:</strong>
        {{ $details['visit_time'] }}
    </p>

    <p>
        <strong>Caravan Type:</strong>
        {{ $details['vehicle_name'] }}
    </p>

    <p>
        Our team will review your request and contact you
        to confirm availability.
    </p>

    <p>
        Please note that your factory visit is not confirmed
        until you receive confirmation from our team.
    </p>

    <p>
        Kind regards,<br>
        <strong>Everest Caravans Team</strong>
    </p>

</body>
</html>
