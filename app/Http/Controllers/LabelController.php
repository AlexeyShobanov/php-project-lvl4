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
        $this->authorize(Label::class);
        $label = new Label();
        $colors = Color::pluck('name', 'id');
        return view('label.create', compact('label', 'colors'));
    }

    public function store(Request $request)
    {
        $this->authorize(Label::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color_id' => 'nullable|integer'
        ]);
        $existingLabel = Label::where('name', $validatedData['name'])->first();
        if ($existingLabel) {
            flash(__('flash.label.create.double'))->warning();
            return redirect()
            ->route('labels.index');
        }
        if (is_null($validatedData['color_id'])) {
            $randomColor = Color::all()
                ->random();
            $validatedData['color_id'] = $randomColor->id;
        }
        Label::create($validatedData);
        flash(__('flash.label.create.success'))->success();
        return redirect()
            ->route('labels.index');
    }
    
    public function edit(Label $label)
    {
        $this->authorize($label);
        $colors = Color::pluck('name', 'id');
        return view('label.edit', compact('colors', 'label'));
    }
    
    public function update(Request $request, Label $label)
    {
        $this->authorize($label);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:labels',
            'description' => 'nullable|string',
            'color_id' => 'nullable|integer'
        ]);
        $label->fill($validatedData)
            ->save();
        flash(__('flash.label.update.success'))->success();
        return redirect()
            ->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $this->authorize($label);
        $label->delete();
        flash(__('flash.comment.remove.success'))->success();
        return redirect()->route('labels.index');
    }
}
