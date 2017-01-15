<?php
header('Content-type:text/html; charset=utf-8');
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


$someArray[1][2][3] = 'end1';
$someArray[1][2][6] = 'end2';
$someArray[1][3][6] = 'end3';
$someArray[4][3][7] = 'end4';

function listArrayRecursive($someArray) {
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($someArray), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $k => $v) {
        $indent = str_repeat('&nbsp;', 10 * $iterator->getDepth());
        // Not at end: show key only
        if ($iterator->hasChildren()) {
            //echo "$indent$k :<br>";
            // At end: show key, value and path
        } else {
            for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                $p[] = $iterator->getSubIterator($i)->key();
            }
            $path = implode(',', $p);
            echo "$indent$k : $v : path -> $path<br>";
        }
    }
}
listArrayRecursive($someArray);
echo "<h3>Program runing is ok!</h3>";
exit;
echo json_encode($data);
