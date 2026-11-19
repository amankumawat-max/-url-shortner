<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - Client Invitation</title>
</head>
<body style="margin:0; padding:0; background-color:#f5f5f5; font-family:Arial, Helvetica, sans-serif;">

    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:650px; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0px 4px 12px rgba(0,0,0,0.1);">
        
        <!-- Logo -->
        <tr>
            <td align="center" bgcolor="#ffffff" style="padding:20px;">
                <a href="{{ url('/') }}">
                    <img src="{{ env('SETTING_IMAGE') }}{{ $site_settings->logo }}" alt="{{ env('APP_NAME') }}" style="width:150px; max-width:100%; height:auto;">
                </a>
            </td>
        </tr>

        <!-- Header -->
        <tr>
            <td align="center" style="padding:20px; background:linear-gradient(90deg, #642922, #e43323);">
                <h2 style="margin:0; color:#ffffff; font-size:22px; letter-spacing:1px;">Client Invitation</h2>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding:25px;">
                <p style="font-size:16px; margin-bottom:20px; color:#333;">
                    Hello {{ $details['client_name'] }},<br><br>
                    You have been invited to join {{ env('APP_NAME') }} as a Client Admin.
                </p>

                <table cellpadding="10" cellspacing="0" width="100%" style="border-collapse:collapse; border:1px solid #eee;">
                    <tr style="background-color:#fceaea;">
                        <td width="30%" style="color:#642922; font-weight:bold;">Client Name:</td>
                        <td style="color:#333;">{{ $details['client_name'] }}</td>
                    </tr>
                    <tr>
                        <td width="30%" style="color:#642922; font-weight:bold;">Email:</td>
                        <td style="color:#333;">{{ $details['client_email'] }}</td>
                    </tr>
                    <tr style="background-color:#fceaea;">
                        <td width="30%" style="color:#642922; font-weight:bold;">Invite Token:</td>
                        <td style="color:#333;">{{ $details['invite_token'] }}</td>
                    </tr>
                </table>

                <p style="font-size:16px; margin-top:25px; color:#333;">
                    Use the invite token to accept the invitation and set your password.
                </p>

                <div style="text-align:center; margin:25px 0;">
                    <a href="{{ rtrim(env('APP_URL'), '/') }}/accept-invite/{{ $details['invite_token'] }}" 
                       style="background:#642922; color:#fff; padding:12px 24px; text-decoration:none; border-radius:5px; display:inline-block;">
                        Accept Invitation
                    </a>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="padding:15px; background-color:#e43323;">
                <p style="margin:0; color:#fff; font-size:13px;">This is an automated email from {{ env('APP_NAME') }}.</p>
            </td>
        </tr>
    </table>

</body>
</html>
