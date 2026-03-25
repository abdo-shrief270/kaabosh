<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'subject',
        'message',
        'company',
        'team_size',
        'product_interest',
        'status',
    ];

    protected $casts = [
        'product_interest' => 'array',
    ];

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeUnresolved($query)
    {
        return $query->where('status', '!=', 'resolved');
    }
}
