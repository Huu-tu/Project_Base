<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mails extends Model
{
    use HasFactory;

    protected $table = 'mails';

    protected $fillable = [
        'title',
        'content',
        'email',
        'sender',
        'variant',
        'needAuthent',
        'need_confirm',
        'need_feedback',
    ];

    public function comments(): HasMany
    {
    	return $this->hasMany(Receivers_mail::class, 'mail_id');
    }

}
