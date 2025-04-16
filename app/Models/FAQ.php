<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = ['question_ar', 'answer_ar', 'question_en', 'answer_en','faq_type_id'];

    public function getQuestionAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->question_en;
        }

        return $this->question_ar;
    }
    public function getAnswerAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->answer_en;
        }

        return $this->answer_ar;
    }



    public function faqType()
    {
        return $this->belongsTo(FaqType::class);
    }
}
