<?php

namespace Dealskoo\MailList\Models;

use Dealskoo\Country\Traits\HasCountry;
use Dealskoo\MailList\Events\Subscribed;
use Dealskoo\MailList\Events\Unsubscribed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Email extends Model
{
    use HasFactory, SoftDeletes, HasCountry, Searchable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'tag',
        'country_id'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $dispatchesEvents = [
        'created' => Subscribed::class,
        'deleted' => Unsubscribed::class
    ];

    public function toSearchableArray()
    {
        return $this->only([
            'first_name',
            'last_name',
            'email',
            'tag',
            'country_id'
        ]);
    }
}
