<?php

namespace App\Traits;

trait Searchable
{
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            foreach ($this->searchable as $column) {
                $q->orWhere($column, 'like', "%{$search}%");
            }
        });
    }

    public function scopeFilter($query, $filters)
    {
        if (!$filters) {
            return $query;
        }

        foreach ($filters as $key => $value) {
            if ($value !== null) {
                $query->where($key, $value);
            }
        }

        return $query;
    }

    public function scopeSort($query, $sortBy, $sortDirection = 'asc')
    {
        if (!$sortBy) {
            return $query;
        }

        return $query->orderBy($sortBy, $sortDirection);
    }
} 