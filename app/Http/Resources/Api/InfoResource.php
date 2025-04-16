<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_ar' => 'جرس',
            'name_en' => 'Garas',
            'logo' => url('').'/'.$this->logo,
            'logo_footer' => url('').'/'.$this->logo_footer,
            'fav_icon' => url('').'/'.$this->icon,
            'slogan_ar' => $this->slogan_ar,
            'slogan_en' => $this->slogan_en,
            'bank_account_num' => $this->bank_account_num,
            'bank_iban_num' => $this->bank_iban_num,
            'bank_qr_image' => $this->bank_qr_image,
            'phone' => $this->phone,
            'whatsapp_phone' => $this->whatsapp_phone,
            'faceboob' => $this->fb,
            'email' => $this->email,
            'twitter' => $this->tw,
            'instagram' => $this->inst,
            'linkedin' => $this->linkedin,
            'snapchat' => $this->snapchat,
            'google_play' => $this->google_play,
            'apple_store' => $this->apple_store,
            'copy_right_ar' => $this->copy_right_ar,
            'copy_right_en' => $this->copy_right_en,
            'commision_buy' => $this->commision_buy,
            'commision_rent' => $this->commision_rent,
            'honisty_ar' => $this->honisty_ar,
            'honisty_en' => $this->honisty_en,
            'ad_conditions_ar' => $this->ad_conditions_ar,
            'ad_conditions_en' => $this->ad_conditions_en,
        ];
    }
}
