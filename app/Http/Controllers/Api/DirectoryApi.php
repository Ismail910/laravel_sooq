<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\Directory;

class DirectoryApi extends Controller
{
    use GeneralTrait;

    protected $filters;

    function __construct()
    {
        $this->filters = [
            'category_id',
            'subcategory_id',
            'city_id',
            'user_id',
            'active',
            'type',
            'created_at',
            'updated_at',
        ];
    }

    public function get_query($filters = [])
    {
        /**
         * $filters = [
         *     ['key', 'operator', 'value'],
         *     ['key', 'operator', 'value'],
         *     ['key', 'operator', 'value'],
         *     ['key', 'operator', 'value'],
         * ]
        */    
        $query = Directory::query();

        foreach($filters as $filter) {
            // Check if filter key exists in $this->filters array
            if (in_array($filter[0], $this->filters)) {
                $query->where($filter[0], $filter[1], $filter[2]);
            }
        }
    
        return $query->get();
    }

    public function get_all_directories($filters = [])
    {
        $directories = $this->get_query($filters);
        return $this->returnData("individual_directories", $directories, "All individual directories");
    }

    public function get_individual_directories($filters = [])
    {
        $filters[] = ['type', '=', 1];
        $directories = $this->get_query($filters);
        return $this->returnData("individual_directories", $directories, "All individual directories");
    }

    public function get_companies_directories($filters = [])
    {
        $filters[] = ['type', '=', 2];
        $directories = $this->get_query($filters);
        return $this->returnData("companies_directories", $directories, "All companies directories");
    }
}
