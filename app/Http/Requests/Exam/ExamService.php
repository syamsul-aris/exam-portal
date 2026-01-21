<?php

class StoreExamRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('Lecturer');
    }

    public function rules()
    {
        return [
            'title'      => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'duration'   => 'required|integer|min:1',
        ];
    }
}
