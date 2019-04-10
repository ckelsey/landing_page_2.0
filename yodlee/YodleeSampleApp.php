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
-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCDBOubcZTkhb1OEK+iW++SdxSN
+Mj1vFkZU1YYp4KWyGSX0KUcg8eB/xZJ+b1sBBzmrJP+jY6Ly7uQfh0+rafCyULWFPAoc+CpH2b2
rRj9HFaywST2njJULG35vwmegIH1/jDPEi+5esw6KIKEpJA+gp+wG59x2oqVhtKbfcwBWaXFBQe2
PfWyKbX2hNSecKFQBbFlr7rmnlRkm3yiXqKxFz5jOkld+W5U9pDj6iFOxVzWBKsKAKua/ilN1HKs
z3K+1USbb95Iufv4tX19TbgqaOrtONps5WaI94NqaOlCbQaFQ65ShFluCQeNePqFPwbHVhNq5GZc
KWIc8AkFw2w1AgMBAAECggEAewrk5U+Ov+oldSnQd86VN9yjLg1lVPn0RwdvhKnTxx0c80IbvaK4
e4n++awTS1y1c6DBP77bDshfNnxppJJbSV/PZ9O0Epl4c/usq562KAY0GZ2vw/efVlN/WJsjQnp3
EnkMh3sR3MPJBhlDMaSGXl4376CRZdASdAhww1wpeV3Jes9GVDKoJrLccZVpoJ4M1CAwqC8rIXdc
YMou4ScljhhUgt2KdEVk/RymmPMaJTfV9hYw8hn4SZj2ZEP7PO2lmjDZQrkO2Bj57CBcRff2lN+0
/5rr9f6NisaLzkrEau29Q77YwImKZURQ/wv7gm1yPzRsgov1ijpuK/TI3tGMgQKBgQDF+edjqsTW
KdXXdJwlFlCIuKG+ZhRhsYUFPT8od+oUkiD4jwLKGoNE+RJaYGcgY7+++4ii/m/lZbvKxv0bY/ky
XXmaSjtp2vfBAV/jTYBw5Loxvow0QFYs1RjxvS8gzGfP28NoZ5witXfc5IhHHwhlrKRxJtUan9+v
s755vTeH4QKBgQCpa0EslqBus5XnULUsrAj2sgxPorTz2zUgyKxYT7cdjsFapFRCGZj8wV7SS0kw
/cfwoFS6mYO2SI3EY9m+NbZeB4M9hm6EmqXgHqkZ3f5MkEwVS6ya7FTph0NtsKRy0MuCUNrgMXMe
MqOVXk/cpYUedU/7+OWjjGecHWNnHQMe1QKBgHlAzOprLfFpYBJ81iGU4DBMvKuLg9It0qXZ1DPp
9dExisYReQjlYh69WfNGdgMNdOP41L/XjBr4yyKv61d6TKb/PzozWt5DgViRifQChLcgL7XF2cMq
4FzHC2cLkrDI4JAbLjxksOlFMat1wM2mgRMcwP6YZQ7QekT3lqKjND6hAoGAP1ELWYutx9GsK3gZ
Tem5q+EdAsIvWJfLQkZdSt/38r8AekzCBLYmXAg01Ok4IGwoRkDViauH8x8ohIZAwXq3fmrWXK8a
LMrTRXCQCE/UE282UBspFflPPrvDsoH648Iu3LQ1KOayPE32nwNRW4gsuRZk3ynFQRtfOZQuK0JH
gUUCgYEAuxYRpLAUNP3ou/kqovpq9dOTdiR37s3/VJxycBqbqjiDaoBqVBHfjKXycNzerf6VuWvU
fxkJLb5bM3PsZsiqluTSZSbp+Uqwg8DJeXelItsDCmdNtxdsYB+aPN4y4bZCbdlB1qD1rNFA+GyM
pU2E3TDZuU74juMftgqPL6iqUWI=
-----END PRIVATE KEY-----
EOD;

//print_r($_GET);
//var_dump($_REQUEST);
if (isset($_GET["action"]) && !empty($_GET["action"]))
{
    $action = $_GET["action"];
    $jwtToken=$_SESSION['jwtToken'];
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
var_dump($getAccounts);

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
    $newDate = date("Y-m-d", strtotime("-3 month"));
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
