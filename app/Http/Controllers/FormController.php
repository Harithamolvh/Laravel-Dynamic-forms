<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use App\Models\FormFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::latest()->paginate(10); 
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:forms',
            'description' => 'nullable|string',
            'fields' => 'required|array|min:1',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.name' => 'required|string|max:255',
            'fields.*.type' => 'required|string|in:text,email,number,password,textarea,select,radio,checkbox,date,file',
            'fields.*.order' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // Create the form
            $form = Form::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
            ]);

            // Create the form fields
            foreach ($request->fields as $fieldData) {
                FormField::create([
                    'form_id' => $form->id,
                    'label' => $fieldData['label'],
                    'name' => $fieldData['name'],
                    'type' => $fieldData['type'],
                    'options' => $fieldData['options'] ? json_encode($fieldData['options']) : null,
                    'rules' => $fieldData['rules'] ? json_encode($fieldData['rules']) : null,
                    'order' => $fieldData['order'],
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Form created successfully!'
        ]);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
