<?php

namespace App\Http\Controllers\Api\DailyManagement;

use App\Enum\CodeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Accident;
use App\Model\AccidentType;
use App\Traits\ApiTraits;

class AccidentTypeController extends Controller
{
    use ApiTraits;

        /**
         * showdoc
         * @catalog 接口文档/日常管理/事故类型
         * @title 查询类型
         * @description 查询所有类型
         * @method get  application/json
         * @url {{host}}/api/daily-management/accidentTypes/?id=1
         * @param id false int 类型id
         * @json_param yl.test/api/daily-management/accidentTypes
         * @return { "status": 200, "message": "操作成功", "data": [ { "id": 2, "type": "坠楼", "count": 6 }, { "id": 3, "type": "车祸", "count": 5 }, { "id": 4, "type": "跌倒", "count": 3 }, { "id": 5, "type": "草", "count": 0 } ] }
         * @return_param id int 事故类型id
         * @return_param type string 事故类型
         * @return_param count int 发生此事故的人数
         * @remark 备注
         */
    public function types(Request $request)
    {
        $id = $request->get('id');
        if (boolval($id)) {
            return $this->apiReturn(AccidentType::where('id', $id)->get(), CodeEnum::SUCCESS);
        }
        return $this->apiReturn(AccidentType::all(), CodeEnum::SUCCESS);
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/事故类型
         * @title 查询发生某类型事故的所有人
         * @description　查询
         * @method GET  application/json
         * @url {{host}}/api/daily-management/accidentTypes/{id}
         * @param id true int 类型id
         * @param page_size false int per_pagesize
         * @json_param yl.test/api/daily-management/accidentTypes/1
         * @return { "status": 200, "message": "操作成功", "data": { "current_page": 1, "data": [ { "id": 3, "created_at": "1991-02-15 22:33:42", "updated_at": "1991-02-15 22:33:42", "account_id": 10, "level_accident": 0, "type_id": 1, "occurrence_time": 378551900, "duty_personnel": "匡钟", "head": "池致远", "description": "Reprehenderit nulla suscipit consequatur aut magnam." }, { "id": 5, "created_at": "2002-02-12 15:43:27", "updated_at": "2002-02-12 15:43:27", "account_id": 5, "level_accident": 2, "type_id": 1, "occurrence_time": 491014581, "duty_personnel": "俞玉华", "head": "耿帅", "description": "Eum vero inventore distinctio id." }, { "id": 6, "created_at": "2003-05-22 10:33:50", "updated_at": "2003-05-22 10:33:50", "account_id": 7, "level_accident": 1, "type_id": 1, "occurrence_time": 1012734132, "duty_personnel": "雷正业", "head": "栗帆", "description": "Quia sed neque nisi." }, { "id": 8, "created_at": "1985-02-10 10:28:52", "updated_at": "1985-02-10 10:28:52", "account_id": 11, "level_accident": 2, "type_id": 1, "occurrence_time": 1008988420, "duty_personnel": "柳坤", "head": "明琴", "description": "Non exercitationem recusandae dolor." }, { "id": 12, "created_at": "2002-02-20 12:41:45", "updated_at": "2002-02-20 12:41:45", "account_id": 3, "level_accident": 2, "type_id": 1, "occurrence_time": 1522821180, "duty_personnel": "谭琴", "head": "彭鑫", "description": "Omnis officiis ipsa iure sed possimus pariatur." }, { "id": 14, "created_at": "2002-09-19 06:25:24", "updated_at": "2002-09-19 06:25:24", "account_id": 11, "level_accident": 2, "type_id": 1, "occurrence_time": 795197056, "duty_personnel": "席学明", "head": "郜斌", "description": "Ut consectetur consequatur officia ea debitis et aut soluta." } ], "first_page_url": "http://yl.test/api/daily-management/accidentTypes/1?page=1", "from": 1, "last_page": 1, "last_page_url": "http://yl.test/api/daily-management/accidentTypes/1?page=1", "next_page_url": null, "path": "http://yl.test/api/daily-management/accidentTypes/1", "per_page": 15, "prev_page_url": null, "to": 6, "total": 6 } }
         * @return_param id int 事故id
         * @return_param account_id int  账户id
         * @return_param type_id varchar(128) 事故类型id
         * @return_param level_accident tinyint(4) 事故等级, 0-轻微 1-一般　２-严重
         * @return_param occurrence_time int(11) 发生时间
         * @return_param duty_personnel varchar(128) 值班人员
         * @return_param head varchar(32) 负责人
         * @return_param description text 事故描述
         * @remark 备注
         */
    public function show($id, Request $request)
    {
        $page_size = $request->get('page_size', 15);
        return $this->apiReturn(Accident::where('type_id', $id)->paginate($page_size), CodeEnum::SUCCESS);
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/事故类型
         * @title 增加类型
         * @description 增加类型
         * @method POST  application/json
         * @url {{host}}/api/daily-management/accidentTypes
         * @param type true string 类型描述
         * @json_param { "type": "自杀" }
         * @return { "status": 200, "message": "操作成功", "data": { "result": true } }
         * @return_param result bool 是否成功
         * @remark 备注
         */
    public function store(Request $request)
    {
        $data = $request->post();
        $result = AccidentType::insert($data);
        return $this->apiReturn(['result' => $result], CodeEnum::SUCCESS);
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/事故类型
         * @title 更新类型
         * @description 更新类型
         * @method PATCH  application/json
         * @url {{host}}/api/daily-management/accidentTypes
         * @param type false string 类型描述
         * @param id true int 类型id
         * @json_param { "type": "草", "id": 5 }
         * @return { "status": 200, "message": "操作成功", "data": { "result": true } }
         * @return_param result bool 是否成功
         * @remark 备注
         */
    public function update(Request $request, AccidentType $accidentType)
    {
        $data = $request->all();
        $res = $accidentType->where('id', $request->get('id'))->first()->fill($data)->update();

        return $this->apiReturn(['result' => $res], CodeEnum::SUCCESS);
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/事故类型
         * @title 删除类型
         * @description 删除类型
         * @method DELETE  application/json
         * @url {{host}}/api/daily-management/accidentTypes/{id}
         * @param id true int 类型id
         * @json_param yl.test/api/daily-management/accidentTypes/1
         * @return { "status": 200, "message": "操作成功", "data": { "result": true } }
         * @return_param result bool 是否成功
         * @remark 备注
         */
    public function destory($id)
    {
        $res = AccidentType::destroy($id);

        return $this->apiReturn(['result' => $res], CodeEnum::SUCCESS);
    }
}
