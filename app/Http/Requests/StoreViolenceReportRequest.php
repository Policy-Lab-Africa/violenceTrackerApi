<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreViolenceReportRequest extends FormRequest
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
            'ng_state_id'   => 'nullable|exists:ng_states,data_id|integer',
            'ng_local_government_id' => 'nullable|exists:ng_local_governments,data_id|integer',
            'ng_polling_unit_id' => 'required|exists:ng_polling_units,data_id|integer',
            'type_id'       => 'required|exists:violence_types,id|integer',
            'title'         => 'nullable|string|min:5',
            'description'   => 'string|required_without:file_path|max:2500',
            'file'          => 'required_without:description|mimes:jpeg,png,jpg,mp4,mov,ogg,qt,m3u8,3gp,avi,wmv|max:20000',
            'longitude'     => 'nullable|string',
            'latitude'      => 'nullable|string',
        ];
    }
}
