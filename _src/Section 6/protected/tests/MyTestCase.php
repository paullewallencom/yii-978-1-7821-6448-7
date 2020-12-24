<?php
class MyTestCase extends CTestCase {
    
    Public function getTableArray($sql,$keyName='') {
        $db=Yii::app()->db->pdoInstance;
        $sth = $db->query($sql) ;
        $users= $sth->fetchAll();
        $arr=array();
        $varr=array();
        foreach ($users as $u) {
            foreach($u as $k=>$v) {
                if (!is_numeric($k))
                    $varr[$k]=$v;
            }
          //print_r($varr);
            $arr[$varr[$keyName]]=$varr;
            unset($varr);
        }    
        return $arr;
    }
    public function getModelArray($model,$keyName=''){
       $ar=array();
       foreach ($model as $t) {
           if ($keyName!=='')
            $ar[$t->$keyName]=$t->attributes;
           else
            $ar[]=$t->attributes;
               
       }
       return $ar;
    }
    
}
?>
