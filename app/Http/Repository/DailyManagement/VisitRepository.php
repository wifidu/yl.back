<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 04:13:42 PM
 */

namespace App\Http\Repository\DailyManagement;

use App\Model\Visit;

class VisitRepository
{
    protected $visit;

    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    public function store($data)
    {
        return $this->visit->fill($data)->save() ? $this->visit->id : false;
    }

    public function update($data)
    {
        return $this->visit->where('id', $data['id'])->update($data);
    }

    public function show($page, $page_size, $id = '', $start_time = '', $end_time = '')
    {
        $query = $this->visit->query();
        if ($id) {
            return $query = $query->where('id', $id)->get();
        }
        if ($start_time) {
            $query = $query->where('visit_time', '>=', strtotime($start_time));
        }
        if ($end_time) {
            $query = $query->where('visit_time', '<=', strtotime($end_time));
        }

        return $query->paginate($page_size);
    }

    public function destroy($id)
    {
        return $this->visit->where('id', $id)->delete();
    }
}
