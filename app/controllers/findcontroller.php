<?php 
namespace WILAYAPI\CONTROLLERS;

use WILAYAPI\MODELS\ArabicModel;
use WILAYAPI\MODELS\FrenchModel;

class FindController extends AbstractController{

    private $authActions = ["getwilaya","getcommune","getdaira"];
    private $authDataType = ["raw","json","options"];
    
    public function frenchAction(){
        
        // check if action is a right one
        if(!empty($this->_params[0]) && !is_numeric($this->_params[0])){
            if (in_array($this->_params[0],$this->authActions)){
                $action = $this->_params[0];
            }else{
                echo "Error code 100 : Unsupported action";
                exit(0);
            }
        }else{
            echo "Avalaible actions : getwilaya , getcommune , getdaira";
            exit(0);
        }

        //check data type requested
        if (!empty($this->_params[1])){
            
            if(in_array($this->_params[1],$this->authDataType)){
                $type = $this->_params[1];
            }else{
                echo "Error code 200 : Unsupported type";
                exit(0);
            }
        }else{
            echo "Avalaible Types : raw , json , options";
            exit(0);
        }

        // check if data is a number or string
        if(!empty($this->_params[2])){
            $data = $this->_params[2];

            if (is_numeric($data)){
                $frenchData = new FrenchModel();
                if ($data > 0 && $data < 59){
                    // getting wilaya with all format 
                    if ($action === "getwilaya"){
                        if ($type === "raw"){
                            echo  "<pre>".$frenchData->getWilayaNameByCode($data) . "</pre>"."\n";
                        }else if ($type === "options"){
                            $wilaya = $frenchData->getWilayaNameByCode($data);
                            echo  "<option value=\"$wilaya\">" . $wilaya . "</option>";
                        }else if ($type === "json"){
                            echo json_encode($frenchData->getWilayaNameByCode($data));
                        }
                        
                    // getting commune with all format
                    }else if($action === "getcommune"){
                        if ($type === "raw"){
                           foreach($frenchData->getCommuneNameByCode($data) as $communes){
                                echo  "<pre>".$communes->commune . "</pre>"."\n";
                           }
                        }else if ($type === "options"){
                            foreach($frenchData->getCommuneNameByCode($data) as $communes){
                                echo  "<option value=\"$communes->commune\">" . $communes->commune . "</option>";
                           }
                        }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($frenchData->getCommuneNameByCode($data) as $data){
                                $communesArray[] = $data->commune;
                            }
                            $communes = ["communes" => $communesArray];

                            echo json_encode($communes);
                        }
                    // getting daira with all format
                    }else if ($action === "getdaira"){
                        if ($type === "raw"){
                            foreach($frenchData->getDairaNameByCode($data) as $dairas){
                                echo  "<pre>".$dairas->daira . "</pre>"."\n";
                           }
                        }else if($type === "options"){
                            foreach($frenchData->getDairaNameByCode($data) as $dairas){
                                echo  "<option value=\"$dairas->daira\">" . $dairas->daira . "</option>";
                           }
                        }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($frenchData->getDairaNameByCode($data) as $data){
                                $dairasArray[] = $data->daira;
                            }
                            $dairas = ["communes" => $dairasArray];

                            echo json_encode($dairas);
                        }
                    }
                }
            }else{
                $frenchData = new FrenchModel();

                // check if sended data contains "space"
                if (strpos($data,"%20")){
                    $datas = explode("%20",$data);
                    $data = $datas[0]." ".$datas[1];
                }
                $count = count((array)$frenchData->getCommunWilaya($data));
                $data = $frenchData->getCommunWilaya($data);
               
                if ($count === 1){
                    $data = $data[0]->wilaya;
                    // getting wilaya with all format 
                    // PS : when we request getWilaya action and sending wilaya name we get wilaya code
                    if ($action === "getwilaya"){
                        if ($type === "raw"){
                            echo  $frenchData->getWilayaCodeByName($data);
                        }else if ($type === "options"){
                            $wilaya = $frenchData->getWilayaCodeByName($data);
                            $wilaya_name = $frenchData->getWilayaNameByCode($wilaya);
                            echo  "<option value=\"$wilaya\">" . $wilaya_name . "</option>";
                        }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            echo json_encode($frenchData->getWilayaCodeByName($data));
                        }
                        
                    // getting commune with all format
                    }else if ($action === "getcommune"){
                        if ($type === "raw"){
                            foreach($frenchData->getCommuneNameByWilayaName($data) as $communes){
                                 echo  "<pre>".$communes->commune . "</pre>"."\n";
                            }
                         }else if ($type === "options"){
                             foreach($frenchData->getCommuneNameByWilayaName($data) as $communes){
                                 echo  "<option value=\"$communes->commune\">" . $communes->commune . "</option>";
                            }
                         }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($frenchData->getCommuneNameByWilayaName($data) as $data){
                                $communesArray[] = $data->commune;
                            }
                            $communes = ["communes" => $communesArray];

                            echo json_encode($communes);
                         }
                    }else if ($action === "getdaira"){
                        if ($type === "raw"){
                            foreach($frenchData->getDairaNameByWilayaName($data) as $dairas){
                                echo  "<pre>".$dairas->daira . "</pre>"."\n";
                            }
                         }else if ($type === "options"){
                             foreach($frenchData->getDairaNameByWilayaName($data) as $dairas){
                                 echo  "<option value=\"$dairas->daira\">" . $dairas->daira . "</option>";
                            }
                         }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($frenchData->getDairaNameByWilayaName($data) as $data){
                                $dairasArray[] = $data->daira;
                            }
                            $dairas = ["communes" => $dairasArray];

                            echo json_encode($dairas);
                         }
                    }
                }else{
                    echo "use a correct indication to get the correct value";
                    exit(0);
                }

            }
        }
    }

    public function arabicAction(){
        // check if action is a right one
        if(!empty($this->_params[0]) && !is_numeric($this->_params[0])){
            if (in_array($this->_params[0],$this->authActions)){
                $action = $this->_params[0];
            }else{
                echo "Error code 100 : Unsupported action";
                exit(0);
            }
        }else{
            echo "Avalaible actions : getwilaya , getcommune , getdaira";
            exit(0);
        }

        //check data type requested
        if (!empty($this->_params[1])){
            
            if(in_array($this->_params[1],$this->authDataType)){
                $type = $this->_params[1];
            }else{
                echo "Error code 200 : Unsupported type";
                exit(0);
            }
        }else{
            echo "Avalaible Types : raw , json , options";
            exit(0);
        }

        // check if data is a number or string
        if(!empty($this->_params[2])){
            $data = $this->_params[2];

            if (is_numeric($data)){
                $arabicData = new ArabicModel();
                if ($data > 0 && $data < 59){
                    // getting wilaya with all format 
                    if ($action === "getwilaya"){
                        if ($type === "raw"){
                            echo  "<pre>".$arabicData->getWilayaNameByCode($data) . "</pre>"."\n";
                        }else if ($type === "options"){
                            $wilaya = $arabicData->getWilayaNameByCode($data);
                            echo  "<option value=\"$wilaya\">" . $wilaya . "</option>";
                        }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            echo json_encode($arabicData->getWilayaNameByCode($data));
                        }
                        
                    // getting commune with all format
                    }else if($action === "getcommune"){
                        if ($type === "raw"){
                           foreach($arabicData->getCommuneNameByCode($data) as $communes){
                                echo  "<pre>".$communes->commune . "</pre>"."\n";
                           }
                        }else if ($type === "options"){
                            foreach($arabicData->getCommuneNameByCode($data) as $communes){
                                echo  "<option value=\"$communes->commune\">" . $communes->commune . "</option>";
                           }
                        }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($arabicData->getCommuneNameByCode($data) as $data){
                                $communesArray[] = $data->commune;
                            }
                            $communes = ["communes" => $communesArray];

                            echo json_encode($communes, JSON_UNESCAPED_UNICODE);
                        }
                    // getting daira with all format
                    }else if ($action === "getdaira"){
                        if ($type === "raw"){
                            foreach($arabicData->getDairaNameByCode($data) as $dairas){
                                echo  "<pre>".$dairas->daira . "</pre>"."\n";
                           }
                        }else if($type === "options"){
                            foreach($arabicData->getDairaNameByCode($data) as $dairas){
                                echo  "<option value=\"$dairas->daira\">" . $dairas->daira . "</option>";
                           }
                        }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($arabicData->getDairaNameByCode($data) as $data){
                                $communesArray[] = $data->daira;
                            }
                            $communes = ["dairas" => $communesArray];

                            echo json_encode($communes, JSON_UNESCAPED_UNICODE);
                        }
                    }
                }
            }else{
                $arabicData = new ArabicModel();

                // check if sended data contains "space"
                if (strpos($data,"%20")){
                    $datas = explode("%20",$data);
                    $data = $datas[0]." ".$datas[1];
                }
                $count = count((array)$arabicData->getCommunWilaya($data));
                $data = $arabicData->getCommunWilaya($data);
               
                if ($count === 1){
                    $data = $data[0]->wilaya;
                    // getting wilaya with all format 
                    // PS : when we request getWilaya action and sending wilaya name we get wilaya code
                    if ($action === "getwilaya"){
                        if ($type === "raw"){
                            echo  $arabicData->getWilayaCodeByName($data);
                        }else if ($type === "options"){
                            $wilaya = $arabicData->getWilayaCodeByName($data);
                            $wilaya_name = $arabicData->getWilayaNameByCode($wilaya);
                            echo  "<option value=\"$wilaya\">" . $wilaya_name . "</option>";
                        }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            echo json_encode($arabicData->getWilayaCodeByName($data));
                        }
                        
                    // getting commune with all format
                    }else if ($action === "getcommune"){
                        if ($type === "raw"){
                            foreach($arabicData->getCommuneNameByWilayaName($data) as $communes){
                                 echo  "<pre>".$communes->commune . "</pre>"."\n";
                            }
                         }else if ($type === "options"){
                             foreach($arabicData->getCommuneNameByWilayaName($data) as $communes){
                                 echo  "<option value=\"$communes->commune\">" . $communes->commune . "</option>";
                            }
                         }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($arabicData->getCommuneNameByWilayaName($data) as $data){
                                $communesArray[] = $data->commune;
                            }
                            $communes = ["communes" => $communesArray];

                            echo json_encode($communes, JSON_UNESCAPED_UNICODE);
                         }
                    }else if ($action === "getdaira"){
                        if ($type === "raw"){
                            foreach($arabicData->getDairaNameByWilayaName($data) as $dairas){
                                 echo  "<pre>".$dairas->daira . "</pre>"."\n";
                            }
                         }else if ($type === "options"){
                             foreach($arabicData->getDairaNameByWilayaName($data) as $dairas){
                                 echo  "<option value=\"$dairas->daira\">" . $dairas->daira . "</option>";
                            }
                         }else if ($type === "json"){
                            header('content-type:application/json;charset=utf8');
                            foreach($arabicData->getDairaNameByWilayaName($data) as $data){
                                $dairaArray[] = $data->daira;
                            }
                            $dairas = ["dairas" => $dairaArray];

                            echo json_encode($dairas, JSON_UNESCAPED_UNICODE);
                         }
                    }
                }else{
                    echo "use a correct indication to get the correct value";
                    exit(0);
                }

            }
        }
    }
}
?>