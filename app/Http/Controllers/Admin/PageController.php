<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    protected $view = "admin.pages.";
    protected $tbl = "pages";
    protected $skipped = [
        "id", "key", "created_at", "updated_at", "is_active", "image"
    ];
    protected $required = ["title_ar", "title_en", "page_ar", "page_en"];

    public function item($slug)
    {

        $response = [
            'cols' => Schema::getColumnListing($this->tbl),
            'skipped' => $this->skipped,
            'required' => $this->required,
            'item' => page($slug),
        ];

        return view("{$this->view}index")->with($response);
    }

    public function update(PageRequest $request, Page $item)
    {
        $data = $request->except("_token", "_method", "files");

        $update = Page::where('id', $item->id)->update($data);
        if ($update) {
            return back()->with('success', __('Data updated successfully!'));
        }
        return back()->with('error', __('Failed to save data!'))->withInput();
    }
}
