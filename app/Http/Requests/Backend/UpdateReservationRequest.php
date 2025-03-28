<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
                'id' => 'required|exists:patients,id',
                // 'reservation_number'=>'required',          
                'type'=>'required|in:check,recheck,consultation,other',
                'payment'=>'required|in:paid,not paid',
                'cost'=>'required|max:4|regex:/^([0-9\s\-\+\(\)]*)$/',
                'date' => 'required',
                'status'=>'required|in:waiting,entered,finished,cancelled',
                'acceptance'=>'required|in:approved,not_approved',
    
        ];
    }

    public function messages(){
        return[
                // 'reservation_number.required'=>'برجاء أدخال رقم الكشف',
                'type.required'=>'برجاء أدخال نوع الكشف',
                'payment.required'=>'برجاء أدخال حالة الدفع',
                'cost.required'=>'برجاء أدخال المبلغ',
                'cost.max'=>'يجب أن لا يزيد المبلغ عن أريع خانات',
                'cost.regex'=>'يجب أن يكون المبلغ أرقام',
                'date.required'=>'برجاء أدخال تاريخ الكشف',
                'res_status.required'=>'برجاء أدخال حالة الكشف',
        ];
    }
}
