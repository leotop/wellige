<?                                                                                           

    require_once("unisender_api.php");

    /**
    * 
    * @var string $mail
    * @var string $tags -- multiple values must be separated by ',' or they will become one big tag
    * @var sting $name -- optional
    * 
    * @return string
    **/

    function addUnisenderSub($mail){

        $apikey="5r85nry3ekch4jw6oo36shemte7uepcon7nstoua";
        $uni=new UniSenderApi($apikey); 
        //if email already exist in database     
        
        $fields['email']=$mail;
        $result = $uni->subscribe(Array("list_ids"=>4908062,"fields"=>$fields,"double_optin"=>$double_optin));
        $answer = json_decode($result,true);
        if(!$answer['error']){
            echo "success";
        } else {
            echo "error";
        }


    }
?>