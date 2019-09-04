<?php
/**
 * 视频 控制器
 */

namespace app\admin\controller;

use app\common\model\Video as SM;
use think\facade\Request;

class Video extends Common
{
 

    public function initialize()
    {
        parent::initialize();
        $this->model = new SM();
    }

    /**
     * 列表
     */
    public function index()
    {
        if( Request::instance()->isPost() ) {    //post 方式, 获取数据
            $page = input('page',1,'intval');
            $limit = input('limit',10,'intval');
            
            $name = input('s1','');
             

            $where[]= "1=1";
            if( $name ){
                $where[]= "name like '%".$name.'%\'';
            }
    
            $list = $this->model->list_admin($page,$limit,$where);

            return apiJson($list);
            
        } else {    //一般 get 请求, 展示页面
            
            return $this->fetch();
        }
        
    }
    
    /*
     * 添加
     */
    public function add()
    {
        if ( Request::instance()->isPost() ) {
            
            $params = input('post.');

            $M = new SM();
            
            if ( $M->save($params) ) {
                return apiJson('', 0, '添加成功');
            } else {
                return apiJson('', 1, '添加出错');
            }
        } else {
            
            //$this->assign('role', AdminRole::all());
            return $this->fetch();
        }
    }

    /**
     * 修改
     */
    public function update()
    {
        if ( Request::instance()->isPost() ) {

            $params = input('post.');

            $M = SM::get($params['id']);
            
            if ( $M->save($params) ) {
                return apiJson('',0,'修改成功');
            } else {
                return apiJson('',1,'修改失败');
            }
        } else {
            return apiJson('',1,'没有参数');
        }
    }
    
    /**
     * 删除信息
     */
    public function del()
    {
        $id = input('param.Id/d', 0);
        $Mobj = SM::get($id);
        $Mobj->lock = SM::ISLOCK_YES;
        if ($Mobj->save()) {
            return apiJson();
        } else {
            return apiJson('', 1, '删除失败');
        }
    }
    
    
}
