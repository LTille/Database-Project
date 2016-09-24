<?php
    function generateId($idType,$length = 8){
        $chars = '0123456789';  
        $id = $idType;
        for ($i = 0; $i<$length;$i++){
            $id .= $chars[ mt_rand(0,strlen($chars)-1)];
        }
        return $id;
    }
?>