@extends('email.template')

@section('content')
    <td class="p30-15" style="padding: 50px 30px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="h3 pb20"
                    style="color:#114490; font-family:'Noto Sans', Arial,sans-serif; font-size:24px; line-height:32px; text-align:{{ myLang() == 'ar' ? 'right' : 'left' }}; padding-bottom:20px;">
                    {{trans('general.otp_mail')}} :  {{$otp}}
                </td>
            </tr>

        </table>
    </td>
@endsection
