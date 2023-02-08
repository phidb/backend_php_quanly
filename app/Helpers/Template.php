<?php
namespace App\Helpers;
use Config;

class Template {
    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus){

        $xhtml = null;
        $tmplStatus = Config::get('zvn.template.status');

        if (count($itemsStatusCount) > 0) {
            array_unshift($itemsStatusCount, [
                'count' => array_sum(array_column($itemsStatusCount, 'count')),
                'status' => 'all'
            ]);
            
            foreach ($itemsStatusCount as $item) {
                $statusValue = $item['status'];
                $statusValue = array_key_exists($statusValue, $tmplStatus) ? $statusValue : 'default';
                $currentTemplateStatus = $tmplStatus[$statusValue];
                $link = route($controllerName)."?filter_status=". $statusValue;

                $class = ($currentFilterStatus == $statusValue) ? 'btn-danger' : 'btn-info';
                $xhtml .= sprintf('<a href="%s" type="button" class="btn %s">
                            %s <span class="badge bg-white">%s</span>
                            </a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }
        }
        return $xhtml;

    }

    public static function showItemHistory ($by, $time){
        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i> %s</p>
            <p><i class="fa fa-clock-o"></i> %s</p>',$by, date(Config::get('zvn.format.long_time'), strtotime($time)));
        return $xhtml;
    }
    public static function showItemStatus($controllerName, $id, $statusValue){
        $tmplStatus = Config::get('zvn.template.status');
        $statusValue = array_key_exists($statusValue, $tmplStatus) ? $statusValue : 'default';
        $currentTemplateStatus = $tmplStatus[$statusValue];
        $link = route($controllerName. '/status',['status'=> $statusValue, 'id'=> $id]);

        $xhtml = sprintf(
            '<a href="%s" type="button" class="btn btn-round %s">%s</a>',$link, $currentTemplateStatus['class'], $currentTemplateStatus['name']);
        return $xhtml;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt){
        $xhtml = sprintf(
            '<img src="%s" alt="%s" class="zvn-thumb">', asset("images/$controllerName/$thumbName"), $thumbAlt);
        return $xhtml;
    }  
    
    public static function showButtonAction($controllerName, $id){
        $tmplButton = [
            'edit'      => ['class'=>'btn-success',             'title'=>'Edit',    'icon'=>'fa-pencil',    'route-name' => $controllerName . '/form'],
            'delete'    => ['class'=>'btn-danger btn-delete',   'title'=>'Delete',  'icon'=>'fa-trash',     'route-name' => $controllerName . '/delete'],
            'info'      => ['class'=>'btn-info',                'title'=>'View',    'icon'=>'fa-trash',     'route-name' => $controllerName . '/delete']
        ];
        $buttonInArea = [
            'default' => ['edit','delete'],
            'slider' => ['edit','delete'],
        ];
        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : "default";
        $listButtons = $buttonInArea[$controllerName];

        $xhtml = '<div class="zvn-box-btn-filter">';
        foreach($buttonInArea[$controllerName] as $btn){
            $currentButtons = $tmplButton[$btn];
            $link = route($currentButtons['route-name'],['id' => $id]);
            $xhtml .= sprintf(
                '<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" 
                data-original-title="%s">
                <i class="fa %s"></i>
                </a>', $link, $currentButtons['class'], $currentButtons['title'], $currentButtons['icon']);
        }
        $xhtml .= '</div>';
        return $xhtml;
    }
}