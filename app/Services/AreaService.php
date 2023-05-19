<?php
namespace App\Services;

use App\Models\Area;

class AreaService
{
    // 这是一个递归方法
    // $parentId 参数代表要获取子类目的父类目 ID，null 代表获取所有根类目
    // $allCategories 参数代表数据库中所有的类目，如果是 null 代表需要从数据库中查询
    public function getCategoryTree()
    {
        $list = Area::with(['children'])->where('parent_id', 0)->get(['id', 'name as text', 'path as value']);
        // foreach ($list as $key => $value) {
        //     $value['children'] = Area::where('parent_id', $value['value'])->get(['id as value', 'name as text']);
        //     foreach ($value['children'] as $k => $val) {
        //         $val['children'] = Area::where('parent_id', $val['value'])->get(['id as value', 'name as text']);
        //     }
        // }
        return $list;
    }
}