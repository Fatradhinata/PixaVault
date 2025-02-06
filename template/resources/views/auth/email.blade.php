<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    @php
        $url = url('/verify-user') . '/' . $mailData['user_id'];
    @endphp

    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tr>
            <td>
                <table width="600" cellspacing="0" cellpadding="20" border="0" style="background: #ffffff; border-radius: 8px;" align="center">
                    <tr>
                        <td style="font-size: 16px; color: #555;">
                            <h2 style="margin-bottom: 1rem; color: #2f3547">
                                Hello <b>{{ $mailData['username'] }}</b>!
                            </h2>
                            Click the button below to verify your email and start enjoying <b>Pixavault</b>.
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            <a href="{{ $url }}" target="_blank"
                                style="background-color: #2f3547; color: #ffffff; text-decoration: none; padding: 10px 18px; border-radius: 4px; display: inline-block; font-size: 16px;">
                                Verify Email
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; color: #777;">
                            If the button above doesn't work, copy and paste this link into your browser:<br>
                            <a href="{{ $url }}" style="color: #007bff;">{{ $url }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px; color: #aaa;">
                            If you did not request this email, please ignore it.
                            <hr style="margin: 16px auto; border: none;">
                            Regards,<br>
                            <b>PixaVault</b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>

