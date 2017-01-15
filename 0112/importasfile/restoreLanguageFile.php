<?php
/*
 * @Describe restore language as3 file
 */
//require_once "../../setting.php";
//require_once "models/parsecsv/parsecsv.lib.php";
require_once "../../common/parsecsv.lib.php";

$path = "./language_file.csv";

 //describe read cvs file to array
function readCvsFile($path)
{
    $return_array = array();
    $csv = new parseCSV();
    $csv->auto($path);
    foreach($csv->data as $record)
    {
        $return_array[$record['path']][$record['language']][] = array($record['id'], $record['text']);
    }
    return $return_array;
}

// convert array to string
function convertArrayToStr($file_path, array $array)
{
        // language types
        foreach($array as $key=>$value)
        {
            //echo $key .PHP_EOL;
            $language_data = array();
            foreach($value as $record)
            {
                $pos_str = $record[0];
                $text    = $record[1];
                $language_data = processArray($language_data, $pos_str, $text);
                
            }
            // replace file
            replaceContent($file_path, $key, json_encode($language_data, JSON_UNESCAPED_UNICODE));
        }

}

// process array
function processArray($language_data, $pos_str, $value)
{
    $pos_data = explode(',', $pos_str);
    $array_last = &$language_data;
    for($i=0; $i<count($pos_data); $i++)
    {
        $index = intval($pos_data[$i]);
        if(!isset($array_last[$index]))
            $array_last[$index] = [];
        $array_last = &$array_last[$index];
    }
    $array_last = $value;
    return  $language_data;
}

// replace content
function replaceContent($file_path, $language, $replace)
{
    // get file package name
    $target_file_data = file_get_contents($file_path);
    preg_match('/eslvid[\d]+/s', $target_file_data, $match);
    $target_package = $match[0];

    // get template data
    if($language == "EN")
    {
        // get default  template
        $template_data = file_get_contents('./template.as');
    }
    else
    {
        // get already exists template
        $template_data = file_get_contents($file_path);
    }

    //$template_data = iconv("UTF-8","UTF-8", $template_data);


    // replace package name
    $template_data = str_replace("eslvid_x", $target_package, $template_data);
    
    //echo "--------------" .PHP_EOL;
    //echo "file_path:{$file_path}" . PHP_EOL;
    //echo "language:{$language}" . PHP_EOL;
    //echo "replace:{$replace}" . PHP_EOL;

    // replace language
    if($language == 'EN')
    {
        $template_data = str_replace('x_EN', $replace, $template_data);
        if($file_path == '../svn_swap/eslvid23/languages.as')
        {
            echo $replace;
        }
    }
    if($language == 'CN')
    {
        $template_data = str_replace('x_CN', $replace, $template_data);
    }

    file_put_contents($file_path, $template_data);

}

//============ main ================

/*
$array             = array();
$array[0][0]       = "Wat do I do now";
$array[0][1][0][0] = "do";
$array[0][1][0][1] = "to do";
print_r($array);
*/

// step01 read cvs file
$cvs_array = readCvsFile($path);

// step02 replace as file content
//$dir = '/home/gongbiao/php/1212/svn_swap/';
$dir = '../svn_swap/';
foreach($cvs_array as $path=>$eslvid_data)
{
    $path = $dir . $path . '/languages.as';
    echo "process path $path" . PHP_EOL;
    //sleep(1);
    convertArrayToStr($path, $eslvid_data);
}


// test replace content demo
$file_path = "/home/gongbiao/php/1212/svn_swap/eslvid1/demo.as";
$language = "EN";
$replace = <<<ET
[	["Test replace?", [["11", "22 333"]]],
    ["Do you need help? ", [["help", "to help"]]],
    ["No, I can do it. ", [["No", "no"], ["do", "to do"]]],
    ["Do you have a microphone? ", [["microphone"]]],
    ["Yes. Here is my microphone. ", [["Yes", "yes"], ["microphone"]]],
    ["OK. Click the Record button. ", [["OK"], ["Record", "to record"], ["button"]]],
    ["Is this the Record button? ", [["Record", "to record"], ["button"]]],
    ["No, but that button does help. ", [["No", "no"], ["button"], ["help", "to help"]]],
    ["Hi! I am HelperWoog. How can I help you? ", [["help", "to help"]]],
    ["We need to practice English words. ", [["practice"]]],
    ["These words have no pictures!"],
    ["You have a movie to play. ", [["movie"], ["play", "to play"]]],
    ["Click the Play button. ", [["Play", "to play"], ["button"]]],
    ["It plays something? ", [["plays", "to play"]]],
    ["Yes, it plays a movie. ", [["Yes", "yes"], ["plays", "to play"], ["movie"]]],
    ["You record words in the movie with your microphone. ", [["record", "to record"], ["movie"], ["microphone"]]],
    ["Gooble Gobble!"],
    ["Then what do I do? ", [["do", "to do"]]],
    ["Click the Keep button. ", [["Keep", "to keep"], ["button"]]],
    ["Do you know what to do now? ", [["do", "to do"]]],
    ["Yes, I do! ", [["Yes", "yes"], ["do", "to do"]]],
    ["OK! Click the HelperWoog button if you need more help. ", [["OK"], ["button"], ["help", "to help"]]],
    ["So I click the Cancel button now? ", [["Cancel", "to cancel"], ["button"]]],
    ["No, Cancel starts it over!", [["No", "no"], [" Cancel", "to cancel"]]],
    ["You need lots of help, don't you? ", [["help", "to help"]]]];
ET;



//replaceContent($file_path, $language, $replace);

printf("======= ok =======\n");




