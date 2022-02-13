<?php

namespace Dealskoo\MailList\Models;

use Dealskoo\MailList\Events\Subscribed;
use Dealskoo\MailList\Events\Unsubscribed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified',
        'tag',
        'country_id'
    ];

    protected $dispatchesEvents = [
        'created' => Subscribed::class,
        'deleted' => Unsubscribed::class
    ]
}
