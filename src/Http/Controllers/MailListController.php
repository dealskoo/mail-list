<?php

namespace Dealskoo\MailList\Http\Controllers;

use Dealskoo\MailList\Models\Email;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class MailListController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function handle(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:emails'],
        ]);
        $email = new Email($request->only([
            'first_name',
            'last_name',
            'email',
            'email_verified_at',
            'tag'
        ]));
        $email->country_id = $request->country()->id;
        $email->tag = $email->tag ?: config('email-list.default_tag');
        $email->save();
        if ($request->ajax()) {
            return ['success' => __('Thanks for subscribing!')];
        } else {
            return back()->with('success', __('Thanks for subscribing!'));
        }
    }
}
