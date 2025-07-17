<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

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
    public function store(Request $request){
dd($request->all());
        $form = Form::with('fields')->findOrFail($request->id);
    
        // Build validation rules from form_fields
        $rules = [];
        foreach($form->fields as $field) {
            if($field->rules) {
                $rules[$field->name] = json_decode($field->rules);
            }
        }
    
        $request->validate($rules);
    
        dd($request->all());
        
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
