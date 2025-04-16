@extends('email.template')

@section('content')
    <td class="p30-15" style="padding: 50px 30px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="h3 pb20"
                    style="color:#114490; font-family:'Noto Sans', Arial,sans-serif; font-size:24px; line-height:32px; text-align:{{ myLang() == 'ar' ? 'right' : 'left' }}; padding-bottom:20px;">
                    @lang('Forgot Password Email')
                </td>
            </tr>
            <tr>
                <td class="text pb20"
                    style="color:#777777; font-family:'Noto Sans', Arial,sans-serif; font-size:14px; line-height:26px; text-align:{{ myLang() == 'ar' ? 'right' : 'left' }}; padding-bottom:20px;">

                    <b>@lang('You can reset password from below link:')</b>
                </td>
            </tr>
            <!-- Button -->
            <tr>
                <td align="center">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="text-button"
                                style="background:#114490; color:#ffffff; font-family:'Noto Sans', Arial,sans-serif; font-size:14px; line-height:18px; padding:12px 20px; text-align:center; border-radius:6px;">
                                <a href="{{ route('admin.resetPassword', $token) }}" target="_blank" class="link-white"
                                    style="color:#ffffff; text-decoration:none;"><span class="link-white"
                                        style="color:#ffffff; text-decoration:none;">@lang('Reset Password')</span></a>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            <!-- END Button -->
        </table>
    </td>
@endsection
