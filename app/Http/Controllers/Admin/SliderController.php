<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Services\UploaderService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\SliderRequest;

class SliderController extends Controller
{
    protected $view = "admin.sliders.";
    protected $tbl = "sliders";
    protected $skipped = [
        "id", "created_at", "updated_at",
    ];
    protected $required = ["image", "description_ar", 'description_en'];
    protected $thead = ["#", "Image"];

    public function index(Request $request)
    {
        $query = Slider::query();
        $per_page = $request->per_page ?? PAGGER;

        $response = [
            'items' => $query->orderby('id', 'desc')->paginate($per_page),
            'thead' => $this->thead,
        ];

        return view("{$this->view}index")->with($response);
    }

    public function create()
    {
        $response = [
            'cols' => Schema::getColumnListing('sliders'),
            'required' => $this->required,
            'skipped' => $this->skipped,
        ];

        return view("{$this->view}create")->with($response);
    }

    public function edit(Slider $item)
    {
        $response = [
            'cols' => Schema::getColumnListing('sliders'),
            'required' => $this->required,
            'skipped' => $this->skipped,
            'item' => $item,
        ];

        return view("{$this->view}edit")->with($response);
    }

    public function store(SliderRequest $request, UploaderService $uploaderService)
    {
        $data = $request->except('_token');

        if ($request->image) {
            $data['image'] = $uploaderService->upload($request->image, 'slider');
        }

        $create = Slider::create($data);
        if ($create) {
            return redirect()->route('admin.sliders.index')->with('success', __('Data saved successfully!'));
        }
        return back()->with('error', __('Failed to save data!'))->withInput();
    }

    public function update(SliderRequest $request, $id, UploaderService $uploaderService)
    {
        $data = $request->except('_token', '_method');
        if ($request->hasFile('image')) {
            $data['image'] = $uploaderService->upload($request->image, 'slider');
        }

        $update = Slider::where('id', $id)->update($data);
        if ($update) {
            return redirect()->route('admin.sliders.index')->with('success', __('Data saved successfully!'));
        }
        return back()->with('error', __('Failed to save data!'))->withInput();
    }

    public function destroy($id)
    {
        $item = Slider::find($id);
        if (!$item) {
            return 0;
        }

        if ($item->delete()) {
            return 1;
        } else {
            return 0;
        }
    }
}
