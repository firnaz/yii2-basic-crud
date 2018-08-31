<?php
    $type = "";
    $message = "";
    $msg = "";
    
    if($messages){
        $msg = $messages['message'];
        $type = $messages['type'];

        if(is_array($msg)){
            $msgs = [];
            foreach ($msg as $m) {
                if(is_array($m)){
                    $message=$m[0];
                }else{
                    $message=$m;
                }
            }
        }else{
            $message = $msg;
        } 
    }
    else{
        return "";
    }
?>
<br /> 
<div class="callout callout-<?= $type ?>">
    <p> <?= $message ?> </p>
</div>
