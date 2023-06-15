<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'content',
        'name',
        'user_id',
        'post_id'
    ];

    public function replies(): HasMany
    {
    	return $this->hasMany(Reply::class, 'comment_id');
    }
}
