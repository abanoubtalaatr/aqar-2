<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('logo');
            $table->string('logo_footer')->nullable();
            $table->string('icon')->nullable();
            $table->string('copy_right_ar')->nullable();
            $table->string('copy_right_en')->nullable();
            $table->string('slogan_ar')->nullable();
            $table->string('slogan_en')->nullable();
            $table->string('bank_qr_image')->nullable();
            $table->string('bank_account_num')->nullable();
            $table->string('bank_iban_num')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('whatsapp_phone')->nullable();
            $table->string('fb')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('tw')->nullable();
            $table->string('inst')->nullable();
            $table->string('google_play')->nullable();
            $table->string('apple_store')->nullable();
            $table->string('commision_buy')->nullable();
            $table->string('commision_rent')->nullable();
            $table->string('honisty_ar')->nullable();
            $table->string('honisty_en')->nullable();
            $table->string('ad_conditions_ar')->nullable();
            $table->string('ad_conditions_en')->nullable();
            $table->string('about_membership_ar')->nullable();
            $table->string('about_membership_en')->nullable();
            $table->string('membership_benefits_ar')->nullable();
            $table->string('membership_benefits_en')->nullable();
            $table->string('membership_price_for_year')->nullable();
            $table->boolean('ad_active_default_value')->nullable();
            $table->string('membership_conditions_ar')->nullable();
            $table->string('membership_conditions_en')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};
