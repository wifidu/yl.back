<?php
namespace App\Http\Repository\DailyManagement;

use App\Enum\CodeEnum;
use App\Model\Accident;
use App\Model\Account;
use App\Traits\ApiTraits;

class AccidentRepository{
    protected $accident;

    use ApiTraits;

    public function __construct(Accident $accident)
    {
        $this->accident = $accident;
    }

    public function store($accident)
    {
        return $this->accident->fill($accident)->save() ? $accident['account_id'] : false ;
    }

    public function destory($id)
    {
        return $this->accident->find($id)->delete();
    }

    public function update($accident)
    {
        return $this->accident->where('id', $accident['id'])->update($accident);
    }

    public function show($page, $page_size, $start_time = '', $end_time = '', $name = '', $id = '')
    {
        $finder = $this->accident;
        if (isset($id))
            return $finder->where('id', $id)->get();
        if (isset($name))
            return Account::where('member_name', $name)->first()->accidents()->get();
        if (isset($start_time))
            $finder = $finder->where('occurrence_time', '>=', strtotime($start_time));
        if (isset($end_time))
            $finder = $finder->where('occurrence_time', '<=', strtotime($end_time));
        return $finder->with('account')->paginate($page_size);
    }
}
?>
