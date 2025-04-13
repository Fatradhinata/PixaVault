<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievement</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tr>
            <td>
                <table width="600" cellspacing="0" cellpadding="20" border="0" style="background: #ffffff; border-radius: 8px;" align="center">
                    <tr>
                        <td style="font-size: 16px; color: #555;">
                            <h2 style="margin-bottom: 1rem; color: #2f3547">
                                Hello <b>{{ $mailData['username'] }}</b>!
                            </h2>
                            🎉 Huge congratulations on unlocking a new achievement: 
                            <br><br>
                            <strong>{{ $mailData['title'] }}</strong>!
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; color: #777; padding: 0 20px;">
                            Your dedication, creativity, and hard work truly shine, and we’re incredibly proud to have you as part of the Pixavault community.
                            <br><br>
                            To celebrate your accomplishment, your achievement will be proudly featured on your profile, so everyone can see the amazing things you’ve done.
                            <br><br>
                            @if ($mailData['token'])
                            And that’s not all. We’ve also gifted you a <strong>free activation token</strong> to help extend your subscription and continue exploring your creative journey without interruption.
                            <br><br>
                            👉 <a href="{{ route("tokenActivation", $mailData['token']) }}" style="color: #007bff;">Click here</a>  to activate your free token.
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px; color: #aaa;">
                            Keep up the great photography — we can’t wait to see what you’ll achieve next!
                            <hr style="margin: 8px auto; border: none;">
                            Best regards,<br>
                            <b>PixaVault</b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>

