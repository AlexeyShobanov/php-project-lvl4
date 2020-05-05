<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LabelController extends Controller
{
    public const COLORS = [
        '0' => 'red',
        '1' => 'blue',
        '2' => 'green',
        '3' => 'turquoise',
        '4' => 'grey',
        '5' => 'black',
        '6' => 'yellow',
        '7' => 'white'
    ];

    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('create', Label::class);

        return view('label.create', ['colors' => self::COLORS]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Label::class);
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

        if (!$label['color']) {
            $label['color'] = self::COLORS[rand(0, count(self::COLORS) - 1)];
        }

        Label::create($label);

        flash(__('messages.labelAddedSuccessfully'))->success();

        return redirect()
            ->route('labels.index');
    }

    
    public function edit(Label $label)
    {
        $this->authorize('edit', $label);
        $label = Label::findOrFail($label->id);
        return view('label.edit', compact('label'));
    }

    
    public function update(Request $request, Label $label)
    {
        $this->authorize('update', $label);

        $label = Label::findOrFail($label->id);

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
        
        $existingStatusName = Label::where('name', $data['name'])->first();
        if ($existingStatusName) {
            flash(__('messages.labelAlreadyExist'))->warning();
            return redirect()
            ->route('labels.index');
        }

        $label->fill($data)
            ->save();
        
        flash(__('messages.labelUpdatedSuccessfully'))->success();

        return redirect()
            ->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $this->authorize('delete', $label);
        $label = Label::findOrFail($label->id);
        if ($label) {
            $label->delete();
        }
        return redirect()->route('task_statuses.index');
    }
}
