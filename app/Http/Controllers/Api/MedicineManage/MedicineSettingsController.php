<?php


namespace App\Http\Controllers\Api\MedicineManage;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MedicineManage\MedicineSettingsRequest;
use App\Http\Service\MedicineManage\MedicineSettingsService;
use Dingo\Api\Http\Request;

class MedicineSettingsController extends Controller
{
    private $_medicineSettings;
    public function __construct(MedicineSettingsService $MedicineSettingsService)
    {
        $this->_medicineSettings = $MedicineSettingsService;
    }

    /**
     * showdoc
     * @catalog 接口文档/药物管理/用药设置
     * @title 用药设置数据存储
     * @description 用药设置存储的接口
     * @method `post` `application/json`
     * @url {{host}}/api/medicine-management/medicine-setting/
     * @param member_name 必填 string 会员姓名
     * @param bed_number 必填 string 床位号
     * @param remark 必填 text 备注
     * @param drug_settings 必填 text 用药设置
     * @return array {"status":200,"message":"\u64cd\u4f5c\u6210\u529f","data":{"id":{"member_name":"1111","bed_number":"12323123","remark":"12123123","drug_settings":"{\u836f\u54c1\u540d\u79f0: \u767d\u52a0\u9ed1,\u7528\u8981\u5355\u4f4d: \u74f6,\u7528\u836f\u5242\u91cf: 2\u7528\u6cd5: \u53e3\u670d,\u9891\u7387: 3\u6b211\u5929,\u670d\u836f\u65f6\u95f4: 6:00 12:00 18:00},{\u836f\u54c1\u540d\u79f0: \u767d\u52a0\u9ed1,\u7528\u8981\u5355\u4f4d: \u74f6,\u7528\u836f\u5242\u91cf: 2\u7528\u6cd5: \u53e3\u670d,\u9891\u7387: 3\u6b211\u5929,\u670d\u836f\u65f6\u95f4: 6:00 12:00 18:00}","updated_at":"2020-05-30 05:06:32","created_at":"2020-05-30 05:06:32","id":2}}}
     * @json_param {
    "member_name": "1111",
    "bed_number": "12323123",
    "remark": "12123123",
    "drug_settings":"{药品名称: 白加黑,用要单位: 瓶,用药剂量: 2用法: 口服,频率: 3次1天,服药时间: 6:00 12:00 18:00},{药品名称: 白加黑,用要单位: 瓶,用药剂量: 2用法: 口服,频率: 3次1天,服药时间: 6:00 12:00 18:00}"
    }
     * @return_param id int 药品信息id
     * @return_param member_name  string 会员姓名
     * @return_param bed_number  string 床位号
     * @return_param drug_settings  text 用药设置
     * @return_param remark  text 备注
     */
    public function store(MedicineSettingsRequest $request)
    {
        $params = $request->post();
        return $this->_medicineSettings->store($params);
    }
    /**
     * showdoc
     * @catalog 接口文档/药物管理/用药设置
     * @title 用药设置数据详情
     * @description 用药设置数据详情的接口
     * @method `get`
     * @url {{host}}/api/medicine-management/medicine-setting/
     * @return array {"status":200,"message":"\u64cd\u4f5c\u6210\u529f","data":{"id":{"member_name":"1111","bed_number":"12323123","remark":"12123123","drug_settings":"{\u836f\u54c1\u540d\u79f0: \u767d\u52a0\u9ed1,\u7528\u8981\u5355\u4f4d: \u74f6,\u7528\u836f\u5242\u91cf: 2\u7528\u6cd5: \u53e3\u670d,\u9891\u7387: 3\u6b211\u5929,\u670d\u836f\u65f6\u95f4: 6:00 12:00 18:00},{\u836f\u54c1\u540d\u79f0: \u767d\u52a0\u9ed1,\u7528\u8981\u5355\u4f4d: \u74f6,\u7528\u836f\u5242\u91cf: 2\u7528\u6cd5: \u53e3\u670d,\u9891\u7387: 3\u6b211\u5929,\u670d\u836f\u65f6\u95f4: 6:00 12:00 18:00}","updated_at":"2020-05-30 05:06:32","created_at":"2020-05-30 05:06:32","id":2}}}
     * @return_param id int 药品信息id
     * @return_param member_name  string 会员姓名
     * @return_param bed_number  string 床位号
     * @return_param drug_settings  text 用药设置
     * @return_param remark  text 备注
     */
    public function detail($id)
    {
        return $this->_medicineSettings->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/药物管理/用药设置
     * @title 用药设置数据详情
     * @description 用药设置详情的接口
     * @method `get`
     * @url {{host}}/api/medicine-management/medicine-setting/{id}
     * @return array {"status":200,"message":"\u64cd\u4f5c\u6210\u529f","data":{"current_page":1,"data":[{"id":1,"member_name":"ruaruarua","bed_number":"12323123","remark":"12123123","drug_settings":"sdjakshdkajsd","deleted_at":null,"created_at":"2020-05-30 04:58:44","updated_at":"2020-05-30 04:58:44"},{"id":2,"member_name":"1111","bed_number":"12323123","remark":"12123123","drug_settings":"{\u836f\u54c1\u540d\u79f0: \u767d\u52a0\u9ed1,\u7528\u8981\u5355\u4f4d: \u74f6,\u7528\u836f\u5242\u91cf: 2\u7528\u6cd5: \u53e3\u670d,\u9891\u7387: 3\u6b211\u5929,\u670d\u836f\u65f6\u95f4: 6:00 12:00 18:00},{\u836f\u54c1\u540d\u79f0: \u767d\u52a0\u9ed1,\u7528\u8981\u5355\u4f4d: \u74f6,\u7528\u836f\u5242\u91cf: 2\u7528\u6cd5: \u53e3\u670d,\u9891\u7387: 3\u6b211\u5929,\u670d\u836f\u65f6\u95f4: 6:00 12:00 18:00}","deleted_at":null,"created_at":"2020-05-30 05:06:32","updated_at":"2020-05-30 05:06:32"}],"first_page_url":"http:\/\/homestead.test\/api\/medicine-manage\/medicine-setting\/list?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/homestead.test\/api\/medicine-manage\/medicine-setting\/list?page=1","next_page_url":null,"path":"http:\/\/homestead.test\/api\/medicine-manage\/medicine-setting\/list","per_page":25,"prev_page_url":null,"to":2,"total":2}}
     * @return_param id int 药品信息id
     * @return_param member_name  string 会员姓名
     * @return_param bed_number  string 床位号
     * @return_param drug_settings  text 用药设置
     * @return_param remark  text 备注
     * @return_param first_page_url string 第一页地址
     * @return_param from int 第一页页
     * @return_param last_page int 最后一页
     * @return_param last_page_url string 最后一页地址
     * @return_param next_page_url string 下一页页地址
     * @return_param path string 当前接口地址
     * @return_param per_page string 上一页页数
     * @return_param prev_page_url string 上一页地址
     * @return_param to int 当前页
     * @return_param total int 总页数
     */
    public function list(Request $request)
    {
        $page_size = $request->page_size ?? 25;
        return $this->_medicineSettings->list($page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/药品管理/用药设置
     * @title 用药设置删除
     * @description 用药设置信息删除的接口
     * @method `delete`
     * @url  {{host}}/api/medicine-management/medicine-setting/{id}
     * @json_param {id}为所要删除数据的主键id，添加在地址路由最后的{id}
     * @param $id
     * @return array {"status":200,"message":"操作成功","data":""}
     */
    public function delete($id)
    {
        return $this->_medicineSettings->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/药物管理/用药设置
     * @title 用药设置信息搜索
     * @description 用药设置信息搜索的接口
     * @method `get`
     * @url {{host}}/api/medicine-management/medicine-setting/search
     * @param member_name
     * @return array {"status":200,"message":"\u64cd\u4f5c\u6210\u529f","data":[{"id":1,"member_name":"ruaruarua","bed_number":"12323123","remark":"12123123","drug_settings":"sdjakshdkajsd","deleted_at":null,"created_at":"2020-05-30 04:58:44","updated_at":"2020-05-30 04:58:44"}]}
     * @return_param id int 药品信息id
     * @return_param member_name  string 会员姓名
     * @return_param bed_number  string 床位号
     * @return_param drug_settings  text 用药设置
     * @return_param remark  text 备注
     */
    public function search(MedicineSettingsRequest $request)
    {
        $params = $request->get('member_name');
        return $this->_medicineSettings->search($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/药品管理/用药设置
     * @title 用药设置批量删除
     * @description 用药设置批量删除的接口
     * @method `delete`
     * @url  {{host}}/api/medicine-management/medicine-setting/
     * @json_param {"ids":[5,6,7]}
     * @param ids 必选 array 待删除数据项主键id数组
     * @return array {"status":200,"message":"操作成功","data":""}
     */
    public function batchDelete(MedicineSettingsRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_medicineSettings->batchDelete($ids);
    }

}