<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Payment Failed</title>

</head>

<body style="margin:0;
             padding:0;
             background:#f4f4f4;
             font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;
                  padding:40px 0;">

        <tr>

            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;
                              border-radius:12px;
                              overflow:hidden;
                              box-shadow:0 4px 15px rgba(0,0,0,0.1);">

                    {{-- HEADER --}}

                    <tr>

                        <td align="center" style="background:#dc3545;
                                   padding:30px;">

                            <h1 style="color:#ffffff;
                                       margin:0;
                                       font-size:32px;">

                                Payment Failed

                            </h1>

                        </td>

                    </tr>

                    {{-- BODY --}}

                    <tr>

                        <td style="padding:40px;">

                            <h2 style="margin-top:0;
                                       color:#333;">

                                Hello {{ $user->name }},

                            </h2>

                            <p style="font-size:16px;
                                      color:#555;
                                      line-height:1.8;">

                                Unfortunately, your recent payment could not be completed.

                            </p>

                            <p style="font-size:16px;
                                      color:#555;
                                      line-height:1.8;">

                                Don’t worry — your cart items are still saved.
                                You can retry your payment anytime.

                            </p>

                            {{-- BUTTON --}}

                            {{-- <div style="text-align:center;
                                        margin:40px 0;">

                                <a href="{{ route('login') }}" style="background:#dc3545;
                                          color:#ffffff;
                                          text-decoration:none;
                                          padding:14px 30px;
                                          border-radius:8px;
                                          display:inline-block;
                                          font-size:16px;
                                          font-weight:bold;">

                                    Retry Payment

                                </a>

                            </div> --}}

                            <p style="font-size:15px;
                                      color:#777;
                                      line-height:1.7;">

                                If you continue facing issues,
                                please contact our support team.

                            </p>

                            <p style="font-size:15px;
                                      color:#777;">

                                Thank you,<br>
                                Your Store Team

                            </p>

                        </td>

                    </tr>

                    {{-- FOOTER --}}

                    <tr>

                        <td align="center" style="background:#f8f9fa;
                                   padding:20px;
                                   color:#888;
                                   font-size:13px;">

                            © {{ date('Y') }} Your Store.
                            All rights reserved.

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>