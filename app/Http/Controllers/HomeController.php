<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile; 
use Illuminate\Support\Facades\Storage; 

class HomeController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('welcome', compact('forms')); 
    }
    public function show($slug){
        $form = Form::where('slug',$slug)->first();
        return view('filloutForm', compact('form')); 
    }
    public function store(Request $request, $id)
    {
        $form = Form::with('fields')->findOrFail($id);

        $rules = [];
        foreach ($form->fields as $field) {
            if ($field->rules) {
                $fieldRules = json_decode($field->rules, true);
                $transformedRules = [];
                switch ($field->type) {
                    case 'text':
                    case 'textarea':
                    case 'select': 
                    case 'radio':
                    case 'checkbox':
                        $transformedRules[] = 'string';
                        break;
                    case 'email':
                        $transformedRules[] = 'email';
                        break;
                    case 'number':
                        $transformedRules[] = 'numeric';
                        break;
                    case 'date':
                        $transformedRules[] = 'date';
                        break;
                }
                if (is_array($fieldRules)) {
                    foreach ($fieldRules as $ruleName => $ruleValue) {
                        if ($ruleName === 'required' && $ruleValue === true) {
                            $transformedRules[] = 'required';
                        } elseif (in_array($ruleName, ['min_length', 'max_length']) && $ruleValue !== null) {
                            $laravelRuleName = str_replace('_length', '', $ruleName); 
                            $transformedRules[] = $laravelRuleName . ':' . $ruleValue;
                        } elseif ($ruleName === 'email' && $ruleValue === true) {
                            $transformedRules[] = 'email';
                        }
                    }
                }
                $rules[$field->name] = $transformedRules;
            }
        }
        $validatedData = $request->validate($rules);
        foreach ($validatedData as $key => $value) {
            if ($value instanceof UploadedFile) {
                $directory = 'form_submissions/' . $form->id . '/' . rand(100000,2);
                $path = $value->store($directory, 'public');
                $processedData[$key] = $path;
            }else{
                $processedData[$key] = $value;
            }
        }
        $submission = new FormSubmission();
        $submission->form_id = $form->id; 
        $submission->data = json_encode($processedData); 
        $submission->save(); 
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

}
