<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivers_mail extends Model
{
    use HasFactory;

    protected $table = 'receivers_mails';

    protected $fillable = [
        'user_mail',
        'mail_id',
        'confirm',
        'feedback',
    ];

}
