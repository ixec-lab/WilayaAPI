<?php 
namespace WILAYAPI\CONTROLLERS;

use WILAYAPI\MODELS\FrenchModel;

class FindController extends AbstractController{

    private $authActions = ["getwilaya","getcommune","getdaira"];
    private $authDataType = ["brut","json","options"];
    
    public function frenchAction(){

        // check if action is a right one
        if(!empty($this->_params[0]) && !is_numeric($this->_params[0])){
            if (in_array($this->_params[0],$this->authActions)){
                $action = $this->_params[0];
            }
        }else{
            echo "Avalaible actions : getwilaya , getcommune , getdaira";
            exit(0);
        }

        //check data type requested
        if (!empty($this->_params[1])){
            
            if(in_array($this->_params[1],$this->authDataType)){
                $type = $this->_params[1];
            }
        }else{
            echo "Avalaible Types : brut , json , options";
            exit(0);
        }

        // check if data is a number or string
        if(!empty($this->_params[2])){
            $data = $this->_params[2];

            if (is_numeric($data)){
                $frenchData = new FrenchModel();
                if ($data > 0 && $data < 59){
                    if ($action === "getwilaya"){
                        echo $frenchData->getWilayaNameByCode($data);
                    }else if($action === "getcommune"){
                        if ($type === "brut"){
                           foreach($frenchData->getCommuneNameByCode($data) as $communes){
                                echo  "<pre><h4>".$communes->commune . "</h4></pre>"."\n";
                           }
                        }else if ($type === "options"){
                            foreach($frenchData->getCommuneNameByCode($data) as $communes){
                                echo  "<option value=\"$communes->commune\">" . $communes->commune . "</option>";
                           }
                        }else{
                            //echo json_encode($frenchData->getCommuneNameByCode($data));
                            echo "soon ...";
                        }
                    }
                }
            }
        }
    }
}

?>