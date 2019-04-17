<?php

require_once('jwt/vendor/autoload.php');

use \Firebase\JWT\JWT;

error_reporting(E_ALL ^ E_ALL);
ob_end_flush();
session_start();
$ini_array = parse_ini_file(__DIR__."/myapp.ini");

$url = $ini_array["BASE_URL"];
$apiKey = $ini_array["API_KEY"];
$node_url = $ini_array["NODE_URL"];
$linked_acc_url = $ini_array["BASE_URL"].$ini_array["GET_ACCOUNTS_URL"];
$trans_url = $ini_array["BASE_URL"].$ini_array["GET_TRANSACTIONS_URL"];
$cobrand = $ini_array["COBRAND_NAME"];
$apiVersion=$ini_array["API_VERSION"];
$allDataSet = "";

$privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEAzdIJrneH+v6Wpuc7nS37sq6SF/xNAUBvY/c+4FTT0l5c9rXm
CHPM6Epzzmh0LGmbc1qxoy8Mnol6k2mng3ih8GnUIctUvkwfStsz9bEESseTCo21
ptlRMcmvQcthWzOfahTTGBOSjHHvmAcO+X2oktQ9RedhX+vlfSDd0pL2PVAnh29d
sUMu4E6IPFCx5/DcilBPEh5RRzx9QmQ/RHBmC+BkTHCFD0S2hdSqeRprN7IBEyp5
RJ+8iduenLF08ddAaqDEBDW/MHJJYRXMZ4BLN5/WSv1nlrVU3tvONVI1Tl1nbUoe
gch/yOBsF4jNJzttNgoMQU3QoXKt+yvZcf+j1QIDAQABAoIBAQDNJ5ho5FKRmCU4
lnJwmP4zPBj5eY6UOdMOVMvCtisxnMeTTvrM4AiWXmgSjUGHZ3kAwZ0hKGuutyCM
QZsszBi21/YP/WoqCRyD8/1V4C2EEGx774bqmeF5/CwKLByN2OYEyl8jt5azEXqe
EiMWAu/98zpkLF9+SlfEovcYx05VC339ZjZ96g4brnwau19pwgQsH1z8yB3mu/5h
3UIoPUh7r72aymJviJiFQXjUZYU2TQJ3aAGMpyU7UizBGulk3l5+f1onEChR1EAp
H3jv4oxiagqyz9OpP0zIlupxf5mJrkwLfaJQ3JyosXhor0yqUodqsrH+2k29rZY9
RKeTT5ABAoGBAPr1F7euBLu6iDWR+mdJpEE60933M62fiUdEO2ASS/FG6d6Wg4jV
M5AJZXptiapCP7wh0SA1sEmufemvFf44F41EPQj4TVPxFo6mtpdQmtOPfJhsUR1V
Unrilgn6NV9x5tk5KkZS1YgNJYrMFEGF4wfh8TWKwy8Cjj+Q8OkDAeQBAoGBANH0
w5ER2vIcrzzaJDczKd/AwkSMC8dJN3Dc0sEx6tSM8B8k222HiPgwbIvITvghGQae
kKStmof7T6FAG8wAQQxmFWHR81bdko/uubmiyUgoBjjWrCuvHVSnfS/gbAscEiW4
OApRxr7DeCEs87IUagsih9+JRAPS2e3XZwbtkO/VAoGBAKMgPdJ/o0QD9BYeVY5e
KA7elmlqDoWFdk6E47OHMSYc2lh9rfJ745B1CymRmjK57YP012MAgx7h9aa40Kr2
+xgwixwRivJNfEQtyfKByqJKWssZXYCbvYlzT+QcaCUqfMwmhHxBy9sr8INQNLqC
tRiinZAYKteb6asYJADSm6ABAoGAZCr1funY3nfm9w5QBvHnAXRyeseh+vMoezUv
a7LICZ4wFXu9IHVwWJCpyMrJOkJ4MRtHgPm+Zy/0Hsd6O4rHfgXaH7BN+1x8xySr
ATDz/PPze/yXacQDJ1c9N7FHeslqswo/2lSHkI2ra5CJt6VbrnJMBs7zXyuig4Go
Crse0f0CgYEA8Y4mIzn1wQWyc2egE8EWsJuIS92gp7NWf/7wa4Hq+AQUMT1dBPGL
LlcDI+MDU+gGaa0KN1ruh5S8Fy1qPDSnG4i0eK6fkRF7tddTlYO5t7cHVsAiwYyv
aK0Y4ECevY/E2kjSuuFvNaCyrnPFU14jboGZBdE1jCrCiEco9RLWz7w=
-----END RSA PRIVATE KEY-----
EOD;

//print_r($_GET);
//var_dump($_REQUEST);
if (isset($_GET["action"]) && !empty($_GET["action"]))
{
    $action = $_GET["action"];
    $jwtToken=$_SESSION['jwtToken'];
    //echo $jwtToken;
    if($jwtToken != null && strlen($jwtToken) > 0)
    {
        if($action === 'getAccounts')
        {
            $getAccounts = getUserAccounts($linked_acc_url,$cobrand,$apiVersion,$jwtToken);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($getAccounts);

        }
        if($action === 'getFastLinkToken')
        {

            $data = ['jwtToken'=>$jwtToken,'nodeUrl'=>$node_url,'dataset'=>$allDataSet];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);

        }
        if($action === 'getTransactions')
        {
            $accountId = $_GET['accountId'];
            $getTransactions = getTransactions($trans_url, $accountId,$cobrand,$apiVersion,$jwtToken);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($getTransactions);


        }
        if($action === 'deleteAccount')
        {
            $accountId = $_GET['accountId'];
            echo "this is the number of account:$accountId";
            $deleteAccount = deleteAccounts($linked_acc_url, $accountId,$cobrand,$apiVersion,$jwtToken);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($deleteAccount);

        }
    }

}
if (isset($_POST) && !empty($_POST)) {

    $userLogin = $_POST["username"];
    $issuer=$apiKey;

    $iat = time()-90;
    $exp = strtotime("+10 minutes");

    $token = array(
        "iat" => $iat,
        "exp" => $exp,
        "iss"=> $issuer,
        "sub"=>$userLogin
    );

    $jwt = JWT::encode($token, $privateKey, 'RS512');

    $_SESSION['jwtToken']="Bearer ".$jwt;

    $jwtToken=$_SESSION['jwtToken'];

    $getAccounts = getUserAccounts($linked_acc_url, $cobrand,$apiVersion,$jwtToken);
//var_dump($getAccounts);

    if ($getAccounts!=null) {

        $data = ['error' => 'false', 'message' => 'User authentication successfull.'];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);

    } else {
        $data = ['error' => 'true', 'message' => 'Error in user Login, Invalid user credentials.'];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}



    function getUserAccounts($url,$cobrand,$apiVersion,$token)
        {
            $linked_acc_url = $url;
            $jwtToken= 'Authorization:'.$token ;
            $ch2 = curl_init($url);
            curl_setopt($ch2, CURLOPT_URL, $linked_acc_url);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Cobrand-Name:'.$cobrand, 'Api-Version:'.$apiVersion, $jwtToken));
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch2);
            curl_close($ch2);
            $errorDetails = checkForError($response);
            if (!empty($errorDetails)) {
                echo "error in the function";
            } else {
                return $response;

            }
        }


function getTransactions($url, $accountId,$cobrand,$apiVersion,$token)
{
    $newDate = date("Y-m-d", strtotime("-36 month"));
    //echo $newDate;
    $jwtToken= 'Authorization:'.$token ;

    $transactions_acc_url = $url.'?fromDate='.$newDate.'+&accountId='.$accountId;
    //echo $userTokenSession;
    $ch3 = curl_init($url);
    curl_setopt($ch3, CURLOPT_URL, $transactions_acc_url);
    curl_setopt($ch3, CURLOPT_HEADER, 0);
    curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Cobrand-Name:'.$cobrand, 'Api-Version:'.$apiVersion, $jwtToken));
    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch3);
    curl_close($ch3);
      //print_r($response);
    //echo("<script>console.log('Transactions response:".$response."');</script>");


    $errorDetails = checkForError($response);
    if (!empty($errorDetails)) {
        echo "error in the function";
    } else {
        return $response;
    }

}
function deleteAccounts($url, $accountId,$cobrand,$apiVersion, $token)
{
    $jwtToken= 'Authorization:'.$token ;
    $transactions_acc_url = $url.$accountId;
    $ch3 = curl_init($transactions_acc_url);
    curl_setopt($ch3, CURLOPT_URL, $transactions_acc_url);
    curl_setopt($ch3, CURLOPT_HEADER, 0);
    curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Cobrand-Name:'.$cobrand, 'Api-Version:'.$apiVersion, $jwtToken));
    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch3);
    curl_close($ch3);
    //echo "in delete account\n\n";
   // print_r($response);
    echo "\n\n";
    $errorDetails = checkForError($response);
    if (!empty($errorDetails)) {
        echo "error in the function";
    } else {
        return $response;
    }

}


    function checkForError($response)
    {
        $body = $response;
        $responseObj = parseJson($body);
        if (!empty($responseObj['errorCode']))
            return $responseObj;
        else
            return null;
    }

    function parseJson($json)
    {
        return json_decode($json, true);
    }

    ?>
