<?php

namespace App\Http\Requests;

use App\Enums\DnsRecordType;
use App\Enums\MonitorType;
use Illuminate\Foundation\Http\FormRequest;

class MonitorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = collect([
            'monitor_type' => 'required|string|in:' . implode(',', MonitorType::getValues()),
            'friendly_name' => 'required|string|min:3|max:120',
            'heartbeat_interval' => 'required|integer|min:60',
            'max_redirects' => 'required|integer|min:0|max:10',
            'accepted_status_codes' => 'string',
        ]);

        if ($this->request->get('monitor_type') == MonitorType::Http()) {
            $rules = $rules->merge([
                'url' => 'required|url',
            ]);
        } elseif ($this->request->get('monitor_type') == MonitorType::Tcp()) {
            $rules = $rules->merge([
                'hostname' => 'required|ip',
                'port' => 'required|integer|min:1',
            ]);
        } elseif ($this->request->get('monitor_type') == MonitorType::Ping()) {
            $rules = $rules->merge([
                'hostname' => 'required|ip',
            ]);
        } elseif ($this->request->get('monitor_type') == MonitorType::Dns()) {
            $rules = $rules->merge([
                'url' => 'required|ip',
                'resolver_server' => 'required|ip',
                'dns_record_type' => 'required|string|in:' . implode(',', DnsRecordType::getValues()),
            ]);
        }

        return $rules->toArray();
    }
}
