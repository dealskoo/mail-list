<?php

namespace Dealskoo\MailList\Http\Controllers\Admin;

use Carbon\Carbon;
use Dealskoo\Admin\Http\Controllers\Controller;
use Dealskoo\Country\Models\Country;
use Dealskoo\MailList\Models\Email;
use Illuminate\Http\Request;

class MailListController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!$request->user()->canDo('mail-lists.index'), 403);
        if ($request->ajax()) {
            return $this->table($request);
        } else {
            return view('mail-list::admin.mail-list.index');
        }
    }

    private function table(Request $request)
    {
        $start = $request->input('start', 0);
        $limit = $request->input('length', 10);
        $keyword = $request->input('search.value');
        $columns = ['id', 'first_name', 'last_name', 'email', 'email_verified_at', 'tag', 'country_id', 'created_at', 'updated_at'];
        $column = $columns[$request->input('order.0.column', 0)];
        $desc = $request->input('order.0.dir', 'desc');
        $query = Email::query();
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        $query->orderBy($column, $desc);
        $count = $query->count();
        $emails = $query->skip($start)->take($limit)->get();
        $rows = [];
        $can_view = $request->user()->canDo('mail-lists.show');
        $can_edit = $request->user()->canDo('mail-lists.edit');
        $can_destroy = $request->user()->canDo('mail-lists.destroy');
        foreach ($emails as $email) {
            $row = [];
            $row[] = $email->id;
            $row[] = $email->first_name;
            $row[] = $email->last_name;
            $row[] = $email->email;
            $row[] = Carbon::parse($email->email_verified_at)->format('Y-m-d H:i:s');
            $row[] = $email->tag;
            $row[] = $email->country->name;
            $row[] = Carbon::parse($email->created_at)->format('Y-m-d H:i:s');
            $row[] = Carbon::parse($email->updated_at)->format('Y-m-d H:i:s');
            $view_link = '';
            if ($can_view) {
                $view_link = '<a href="' . route('admin.mail-lists.show', $email) . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';
            }

            $edit_link = '';
            if ($can_edit) {
                $edit_link = '<a href="' . route('admin.mail-lists.edit', $email) . '" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>';
            }
            $destroy_link = '';
            if ($can_destroy) {
                $destroy_link = '<a href="javascript:void(0);" class="action-icon delete-btn" data-table="mail-lists_table" data-url="' . route('admin.mail-lists.destroy', $email) . '"> <i class="mdi mdi-delete"></i></a>';
            }
            $row[] = $view_link . $edit_link . $destroy_link;
            $rows[] = $row;
        }
        return [
            'draw' => $request->draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $rows
        ];
    }

    public function create(Request $request)
    {
        abort_if(!$request->user()->canDo('mail-lists.create'), 403);
        $countries = Country::all();
        return view('mail-list::admin.mail-list.create', ['countries' => $countries]);
    }

    public function store(Request $request)
    {
        abort_if(!$request->user()->canDo('mail-lists.create'), 403);
        $request->validate([
            'email' => ['required', 'email', 'unique:emails'],
            'country_id' => ['required', 'exists:countries,id']
        ]);
        $email = new Email($request->only([
            'first_name',
            'last_name',
            'email',
            'email_verified_at',
            'tag',
            'country_id'
        ]));
        $email->save();
        return back()->with('success', __('admin::admin.added_success'));
    }

    public function show(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('mail-lists.show'), 403);
        $email = Email::query()->findOrFail($id);
        return view('mail-list::admin.mail-list.show', ['email' => $email]);
    }

    public function edit(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('mail-lists.edit'), 403);
        $countries = Country::all();
        $email = Email::query()->findOrFail($id);
        return view('mail-list::admin.mail-list.edit', ['countries' => $countries, 'email' => $email]);
    }

    public function update(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('mail-lists.edit'), 403);
        $request->validate([
            'email' => ['required', 'email', 'unique:emails,' . $id . ',id'],
            'country_id' => ['required', 'exists:countries,id']
        ]);
        $email = Email::query()->findOrFail($id);
        $email->fill($request->only([
            'first_name',
            'last_name',
            'email',
            'email_verified_at',
            'tag',
            'country_id'
        ]));
        $email->save();
        return back()->with('success', __('admin::admin.update_success'));
    }

    public function destroy(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('mail-lists.destroy'), 403);
        return ['status' => Email::destroy($id)];
    }
}
