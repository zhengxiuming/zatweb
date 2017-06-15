<?php 

class IndexController extends BaseController {
   public function indexAction() {//默认Action
       $mysql = new DbMysqli();
       if($mysql){
            $row = $mysql->getLine("select * from roles");
            $res = json_encode($row);
            $this->__responseJson($row);
       }
       
   }
}

?>