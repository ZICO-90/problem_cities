<?php

namespace App\Http\Requests\Problems;

use Illuminate\Foundation\Http\FormRequest;

class StoreProblemsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'problem_name' => 'required|string|min:5|max:150' ,
            'tool_defect' => 'nullable|string|min:5|max:150',
            'who_cause_of_defect' => 'nullable|string|min:5|max:150',
            'city_id' => 'required',
            'side_defect_id' => 'required',
            'cause_of_defect_id' => 'required',
            'problem_details' => 'required',
            'files.*' => 'required|mimes:mp4,3gp,mov,avi,wmv,jpg,jpeg,png,pdf',
                ];
    }
}
