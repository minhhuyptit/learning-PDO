<?php
class HTMLHelper{
    public static function showStatus($status){
        $xhtml = '';
        if($status == 'active'){
            $xhtml = '<button type="button" class="btn btn-success btn-sm btn-status">Active</button>';
        }else{
            $xhtml = '<button type="button" class="btn btn-warning btn-sm btn-status">InActive</button>';
        }

        return $xhtml;
    }

    public static function showFilterStatus($arrStatus){
        $xhtml = '';
        foreach ($arrStatus as $status) {
            $xhtml .= '<a href="'.$status['link'].'" class="btn btn-filter '.$status['class'].'">'.$status['name'].' ('.$status['total'].')</a> ';
        }
        return $xhtml;
    }

    public static function cmsLinkSort($name, $column, $columnPost, $orderPost, $option = null){
        $style = !empty($option['style']) ? 'style="'.$option['style'].'"' : '' ;
        $img	= '<i class="fa fa-fw fa-sort"></i>';

        $order	= ($orderPost == 'desc') ? 'asc' : 'desc';
        
        if($column == $columnPost){
            $img	= '<i class="fa fa-fw fa-sort-'.$orderPost.'"></i>';
        }
        $xhtml = '<th '.$style.' class="text-center pointer" id="'.$column.'" onclick="javascript:sortList(\''.$column.'\',\''.$order.'\')">'.$name.$img.'</th>';
        return $xhtml;
 }

}

?>