<?php

namespace App\Http\Controllers;

use App\Label;
use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::whereNull('labels.deleted_at')
            ->paginate(self::PAGINATE_COUNT);
        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('create', Label::class);
        $label = new Label();
        $colors = Color::select('id', 'name')->get()->pluck('name', 'id')->all();
        return view('label.create', compact('label', 'colors'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Label::class);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ], self::MESSAGES);
        if ($validator->fails()) {
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('labels.create')
                ->withErrors($validator)
                ->withInput();
        }
        $label = $validator->valid();
        $existingLabel = Label::where('name', $label['name'])->first();
        if ($existingLabel) {
            flash(__('flash.label.create.double'))->warning();
            return redirect()
            ->route('labels.index');
        }
        if (is_null($label['color_id'])) {
            $randomColor = Color::all()
                ->random();
            $label['color_id'] = $randomColor->id;
        }
        Label::create($label);
        flash(__('flash.label.create.success'))->success();
        return redirect()
            ->route('labels.index');
    }

    
    public function edit(Label $label)
    {
        $this->authorize('update', $label);
        $colors = Color::select('id', 'name')->get()->pluck('name', 'id')->all();
        return view('label.edit', compact('colors', 'label'));
    }

    
    public function update(Request $request, Label $label)
    {
        $this->authorize('update', $label);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ], self::MESSAGES);
        if ($validator->fails()) {
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('labels.edit', ['labels' => request()->all()])
                ->withErrors($validator)
                ->withInput();
        }
        $data = $validator->valid();
        $label->fill($data)
            ->save();
        flash(__('flash.label.update.success'))->success();
        return redirect()
            ->route('labels.index');
    }
    public function destroy(Label $label)
    {
        $this->authorize('delete', $label);
        $label->delete();
        flash(__('flash.comment.remove.success'))->success();
        return redirect()->route('labels.index');
    }
}
