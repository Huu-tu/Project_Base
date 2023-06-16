<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'title',
        'content',
        'email',
        'sender',
        'type',
        'status',
        'is_checked',
        'party',
        'isAuthen'
    ];

    public function comments(): HasMany
    {
    	return $this->hasMany(Comments::class, 'post_id');
    }
}
