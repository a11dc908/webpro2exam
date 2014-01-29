<?php
 
    function is_even($num)
    {
        $num = (int)$num;
        return ($num & 1) ? false : true;
    }
        
        
        function SBC_DBC($str) { 
    $DBC = array(０ , １ , ２ , ３ , ４ ,  ５ , ６ , ７ , ８ , ９);
         $SBC = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
   return str_replace($DBC,$SBC,$str);  //全角到半角

}
 