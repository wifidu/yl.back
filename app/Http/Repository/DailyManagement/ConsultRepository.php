<?php

/*
 * @author weifan
 * Monday 6th of April 2020 01:30:39 PM
 */

namespace App\Http\Repository\DailyManagement;

use App\Model\Consult;

class ConsultRepository
{
    protected $consult;

    public function __construct(Consult $consult)
    {
        $this->consult = $consult;
    }

    public function store($consult)
    {
        return $this->consult->fill($consult)->save() ? $this->consult->id : false;
    }

    public function update($consult)
    {
        return $this->consult->where('id', $consult['id'])->update($consult);
    }

    public function index($page, $page_size, $start_time, $end_time)
    {
        $query = $this->consult;
        if ($start_time) {
            $query = $query->where('time', '>=', strtotime($start_time));
        }
        if ($end_time) {
            $query = $query->where('time', '<=', strtotime($end_time));
        }

        return $query->paginate($page_size);
    }

    public function destroy($id)
    {
        return $this->consult->find($id)->delete();
    }

    public function show($id)
    {
        return $this->consult->where('id', $id)->get();
    }
}
