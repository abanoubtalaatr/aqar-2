<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LangRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LanguageController extends Controller
{
    protected $view = "admin.languages.";
    protected $tbl = "languages";
    protected $skipped = [
        "id", "created_at", "updated_at", "is_active",
    ];
    protected $required = ["name_ar", "name_en"];
    protected $thead = ["#", "Name", "status", "Created Date"];

    public function index(Request $request)
    {
        $query = Language::query();
        $per_page = $request->per_page ?? PAGGER;

        if ($request->name) {
            $query->searchByName($request->name);
        }

        $response = [
            'items' => $query->orderby('id', 'desc')->paginate($per_page),
            'thead' => $this->thead,
        ];
        return view("{$this->view}index")->with($response);
    }

    public function create()
    {
        $response = [
            'cols' => Schema::getColumnListing('languages'),
            'required' => $this->required,
            'skipped' => $this->skipped,
        ];

        return view("{$this->view}create")->with($response);
    }

    public function edit(Language $item)
    {
        $response = [
            'cols' => Schema::getColumnListing('languages'),
            'required' => $this->required,
            'skipped' => $this->skipped,
            'item' => $item,
        ];

        return view("{$this->view}edit")->with($response);
    }

    public function store(LangRequest $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;

        $user = Language::create($data);
        if ($user) {
            return redirect()->route('admin.languages.index')->with('success', __('Data saved successfully!'));
        }
        return back()->with('error', __('Failed to save data!'))->withInput();

    }

    public function update(LangRequest $request, $id)
    {
        $data = $request->except('_token', '_method');
        $user = Language::where('id', $id)->update($data);
        if ($user) {
            return redirect()->route('admin.languages.index')->with('success', __('Data saved successfully!'));
        }
        return back()->with('error', __('Failed to save data!'))->withInput();
    }

    public function destroy($id)
    {
        $item = Language::find($id);
        if (!$item) {
            return 0;
        }

        if ($item->delete()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function changeStatus($id)
    {
        $item = Language::find($id);
        if (!$item) {
            return 0;
        }

        $newStatus = $item->is_active == 1 ? 0 : 1;
        $item->is_active = $newStatus;

        if ($item->save()) {
            return 1;
        } else {
            return 0;
        }
    }
}
