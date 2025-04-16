<?php

namespace App\Http\Controllers\Api;

use App\Models\Info;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\Setting;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\InfoResource;
use App\Http\Requests\Api\ContactRequest;
use App\Http\Resources\Api\PartnerResource;
use App\Services\General\FormatFileService;

class SettingController extends Controller
{
    use GeneralTrait;

    public function info()
    {
        $info = Info::first();
        $info = new InfoResource($info);

        return $this->returnData('data', $info);
    }

    public function partners()
    {
        $partners = Partner::get();
        $partners_data = PartnerResource::collection($partners);

        return $this->returnData('data', $partners_data);
    }

    public function contact(ContactRequest $request)
    {
        // return "d";
        // return $request ;
        $data = $request->validated();
        $data['name'] = auth()->user()->name;
        $data['email'] = auth()->user()->email;
        $data['phone'] = auth()->user()->phone;
        $contact = Contact::create($data);

        // $this->send_notii('contactNotification', $contact, 'browse_contact', $request['name']);
        return $this->returnSuccessMassage(__('api.Sent Successfully'), 201);
    }

    public function commissionAndPayOnline()
    {
        $info = Info::first();

        $data['commision_buy'] = number_format($info->commision_buy, 2, '.', '');
        $data['commision_rent'] = number_format($info->commision_rent, 2, '.', '');
        $data['commission_for_order_rent'] = number_format($info->commission_for_order_rent, 2, '.', '');
        $data['commission_for_order_sell'] = number_format($info->commission_for_order_sell, 2, '.', '');
        $data['commission_for_ad_gold_rent'] = number_format($info->commission_for_ad_gold_rent, 2, '.', '');
        $data['commission_for_ad_gold_sell'] = number_format($info->commission_for_ad_gold_sell, 2, '.', '');
        $data['account_number'] = $info->account_number;
        $data['bank_name_ar'] = $info->bank_name_ar;
        $data['bank_name_en'] = $info->bank_name_en;
        $data['bank_image'] = FormatFileService::formatIfString($info->bank_image, '');
        $data['iban'] = $info->iban;

        return $this->returnData('data', $data);
    }

    public function settings()
    {
        $settings = Setting::all()->mapWithKeys(function ($setting) {
            return [$setting->key => $setting->value]; // The accessor will handle file formatting
        });

        return $this->returnData('data', $settings);
    }
}
