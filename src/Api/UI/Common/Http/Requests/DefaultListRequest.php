<?php declare(strict_types=1);

namespace Api\UI\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DefaultListRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    protected function getPage(): ?int
    {
        $val = $this->get('page');
        return ($val) ? (int)$val : null;
    }

    protected function getLimit(): ?int
    {
        $val = $this->get('limit');
        return ($val) ? (int)$val : null;
    }

    protected function getPagination(): array
    {
        return [
            'page' => $this->getPage(),
            'limit' => $this->getLimit()
        ];
    }

    public function getData(): array
    {
        return [
            'pagination' => $this->getPagination(),
            'order' => $this->get('order')
        ];
    }
}
