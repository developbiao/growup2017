<html>
<head>
    <title>POST data using fsockopen() Function</title>
    <meta content="noindex, nofollow" name="robots">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    $data = $_POST['emp_name'];
    $host = "192.168.199.38";
    $path = "/growup2017/0212/second.php";
    $post_data = 'name=' . $data;
    $socket = fsockopen($host, 80, $errno, $errstr, 15);
//Checks if the connection was fine
    if (!$socket) {
//If connection gets fail then it will display the error number & message and will stops the script from continue working
        echo ' error: ' . $errno . ' ' . $errstr;
        die;
    } else {
//This tells the web server what version of HTTP protocol we are using and the file to which we are sending request
        $http = "POST $path HTTP/1.1\r\n";

//This is the url or IP of which the request is coming from
        $http .= "Host: $host\r\n";

//The user agent being used to send the request
        $http .= "User-Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n";

//The content type, this is important and much look like the following if sending POST data.
//If this is not provided the server may not process the POST data
        $http .= "Content-Type: application/x-www-form-urlencoded\r\n";

//Lets the web server know the total length/size of are posted content
//It is not always required but some servers will refuse requests if not provided
        $http .= "Content-length: " . strlen($post_data) . "\r\n";

//Tells the server whether header request is completed and the rest if content / POST data
        $http .= "Connection: close\r\n\r\n";

//Add data to be sent
        $http .= $post_data . "\r\n\r\n";

//Sends header data to the web server
        fwrite($socket, $http);

//Waits for the web server to send the full response. On every line returned we append it onto the $contents
//variable which will store the whole returned request once completed.
        while (!feof($socket)) {
            $contents[] = fgets($socket, 4096);
        }
//Close are request or the connection will stay open until script has completed.
        fclose($socket);
    }
}
?>
<div id="main">
    <h1>POST data using fsockopen() Function</h1>
    <div id="login">
        <h2> fsockopen() Function </h2>
        <hr/>
        <form action="first.php" method="POST">
            <center><span style="color: green;"><?php
                    if (isset($contents[8])) {
                        echo $contents[8] == '' ? '' : $contents[8];
                    }
                    ?></span></center>
            <br/>
            <br/>
            <label>Enter Name :</label>
            <input type="text" name="emp_name" required="required" placeholder="Please Enter Name"/><br/><br/>
            <input type="submit" value="Click Here" name="submit"/><br/>
        </form>
        <br/>
    </div>
</div>
</body>
</html>