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

}

?>