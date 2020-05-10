<?php

namespace App\Http\Controllers;

use App\Label;
use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LabelController extends Controller
{
    public function index()
    {
        $labels = \DB::table('labels')
        ->leftJoin('colors', 'colors.id', '=', 'labels.color_id')
        ->select(
            'labels.*',
            'colors.name as color_name'
        )
        ->whereNull('labels.deleted_at')
        ->get();
        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('create', Label::class);
        $colors = Color::select('id', 'name')->get()->pluck('name', 'id')->all();
        return view('label.create', compact('colors'));
    }

    public function store(Request $request)
    {
        $this->authorize('store', Label::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ], self::MESSAGES);
        
        if ($validator->fails()) {
            flash(__('messages.incorrectDataEntered'))->error();
            return redirect()
                ->route('labels.create')
                ->withErrors($validator)
                ->withInput();
        }
        
        $label = $validator->valid();
        
        $existingLabel = Label::where('name', $label['name'])->first();
        if ($existingLabel) {
            flash(__('messages.labelAlreadyExist'))->warning();
            return redirect()
            ->route('labels.index');
        }

        if (is_null($label['color_id'])) {
            $randomColor = Color::all()
                ->random();
            $label['color_id'] = $randomColor->id;
        }

        Label::create($label);

        flash(__('messages.labelAddedSuccessfully'))->success();

        return redirect()
            ->route('labels.index');
    }

    
    public function edit(Label $label)
    {
        $this->authorize('edit', $label);
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
            flash(__('messages.incorrectDataEntered'))->error();
            return redirect()
                ->route('labels.edit', ['labels' => request()->all()])
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->valid();
        $label->fill($data)
            ->save();
        
        flash(__('messages.labelUpdatedSuccessfully'))->success();

        return redirect()
            ->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $this->authorize('delete', $label);
        if ($label) {
            $label->delete();
        }
        return redirect()->route('labels.index');
    }
}
