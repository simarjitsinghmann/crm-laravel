<?php 
if (! function_exists('hideEmail')) {
        function hideEmail($email) {
            $em   = explode("@",$email);
            $name = implode(array_slice($em, 0, count($em)-1), '@');
            $len  = floor(strlen($name));
            return substr($name,0, $len-($len-1)) . str_repeat('*', $len-2) .substr($name,$len-1,1) . "@" . end($em); 
     }
}
if (! function_exists('hidecontact')) {
    function hidecontact($number) {
        $em   = $number;
        $len  = floor(strlen($number));
        return substr($em,0, $len-($len-1)) . str_repeat('*', $len-2) .substr($em,$len-1,1); 
 }
}