<?php   
   //Remote
   
    //  define("SERVER","localhost");
    //  define("USER","root");//rajib
    //  define("DATABASE","test");
    //  define("PASSWORD","");

   //Local
   
    //define("SERVER","localhost");
    //define("USER","root");//rajib
    //define("DATABASE","hosting");
    //define("PASSWORD","");

    //shawon
    define("SERVER","localhost");
    define("USER","root");//Sahwon
    define("DATABASE","hotelmngmnt_shaan");
    define("PASSWORD","");

    $db=new mysqli(SERVER,USER,PASSWORD,DATABASE);
    $tx="ht_"; //table prefix if any table name start with core_     

?>