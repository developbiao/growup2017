<?php
require_once "../../setting.php";
require_once "models/parsecsv/parsecsv.lib.php";
$path = 'languages.aslanguages.as';
$language = 'EN';
$data = [	["What do I do now?", [["do", "to do"]]],
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


function analyze($path, $language, $data)
{

}

// TODO:: save row data to csv file
function saveRow($path, $language, $id, $text)
{
    $fp = fopen('language_file.csv', 'a');
    $list = array($path, $language, $id, $text);
    fputcsv($fp, $list);
    fclose($fp);
}

// save data to csv
function saveDataToCsv($path, $language, $data)
{
    for($i=0; $i<count($data); $i++)
    {
        if(is_array($data[$i]))
        {
            saveDataToCsv($path, $language, $i, $data);
        }
        else
        {
            $list = array($path, $language, $i, $data[$i]);
            printf("-------\n");
            print_r($list);
            /*
            $fp = fopen("language_file.csv", "a");
            $list = array($path, $language, $i, $data);
            fputcsv($fp, $list);
            fclose($fp);
            */
        }
    }
}

saveDataToCsv($path, $language, $data);

/*
$id = "001";
$text = "1111";
for($i=0; $i<6; $i++)
{
    saveRow($path, $language, $id, $text);
}
*/

printf("========= OK =========\n");
