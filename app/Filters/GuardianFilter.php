<?php

namespace App\Filters;

use Hashemi\QueryFilter\QueryFilter;

class GuardianFilter extends \Hashemi\QueryFilter\QueryFilter
{
    public function applyIdProperty($id=NULL)
    {
        return $this->builder->where('id', '=', $id);
    }

    public function applyNameProperty($name=NULL)
    {
        return $this->builder->where('name', 'LIKE', "%$name%");
    }

    public function applyEmailProperty($email=NULL)
    {
        return $this->builder->where('email', 'LIKE', "%$email%");
    }
}
