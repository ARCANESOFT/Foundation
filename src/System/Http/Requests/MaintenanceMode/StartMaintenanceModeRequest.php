<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Requests\MaintenanceMode;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     StartMaintenanceModeRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StartMaintenanceModeRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'message'          => [
                'nullable',
                'string',
            ],
            'retry'            => [
                'nullable',
                'integer',
                'min:0',
            ],
            'allowed'          => [
                'nullable',
                'string',
            ],
            'allow_current_ip' => [
                'boolean',
            ],
            'ips.*'            => [
                'nullable',
                'ip',
            ],
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'ips' => $this->parseIPs(),
        ]);
    }

    /**
     * Parse the allowed IPs into an array.
     *
     * @return array
     */
    private function parseIPs(): array
    {
        $ips = explode(PHP_EOL, (string) $this->input('allowed'));

        if ((bool) $this->input('allow_current_ip'))
            $ips[] = $this->ip();

        return array_unique(array_filter($ips));
    }
}
