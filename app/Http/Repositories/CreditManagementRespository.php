<?php
namespace App\Http\Respositories;

use App\Models\CreditManagement;

class CreditManagementRespository
{
    protected $creditManagement;

    public function __construct(CreditManagement $CreditManagement)
    {
        $this->creditManagement = $CreditManagement;
    }

    public function save()
    {
        
    }

    public function show()
    {
        return $this->creditManagement->all();
    }
}
?>
