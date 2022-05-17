<?php

namespace App\Http\Requests\Problems;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProblemsRequest extends FormRequest
{


    protected $rules = [
        
            'problem_name' => 'required|string|min:5|max:150' ,
            'tool_defect' => 'nullable|string|min:5|max:150',
            'who_cause_of_defect' => 'nullable|string|min:5|max:150',
            'city_id' => 'required',
            'side_defect_id' => 'required',
            'cause_of_defect_id' => 'required',
            'problem_details' => 'required',
            'files.*' => 'sometimes|mimes:mp4,3gp,mov,avi,wmv,jpg,jpeg,png,pdf',
            'fileCheck' => 'sometimes|mimes:mp4,3gp,mov,avi,wmv,jpg,jpeg,png,pdf',
            'check' => 'sometimes|integer',
           
       
    ];
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
        if(!is_null($this->fileCheck)){
            if(is_null($this->check)){
          // dd('check>' , $this->check) ;
                $this->rules['check'] = 'required' ;
                return $this->rules;
                
            }
            
      
        }

        if(!is_null($this->check)){
            if(is_null($this->fileCheck) ){
                  //  dd('fileCheck>' ,$this->fileCheck) ;
                $this->rules['fileCheck'] = 'required' ;
          
                return $this->rules;
            }
        }
     

        return $this->rules;
                
    }

   
}
