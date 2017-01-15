<?php
/*
 * @describe import as3 file variable array to cvs
 */
//$folder = "/home/gongbiao/php/1212/svn_swap/languages.as";
$folder = "../svn_swap/languages.as";

function scan($pattern, $flags = 0)
{
    $files = glob($pattern, $flags);

    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
    {
        $files = array_merge($files, scan($dir.'/'.basename($pattern), $flags));
    }

    return $files;
}

function analyze($path, $language, $data)
{
    $array = eval("return $data");
    //my_walk_recursive($path, $language, $array);
    listArrayRecursive($array, $path, $language);
}

function listArrayRecursive(array $someArray, $file_path, $language) {
    //reference: http://stackoverflow.com/questions/7590662/walk-array-recursively-and-print-the-path-of-the-walk
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($someArray), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $k => $v) {
        //$indent = str_repeat('&nbsp;', 10 * $iterator->getDepth());
        // Not at end: show key only
        if ($iterator->hasChildren()) {
            //echo "$indent$k :<br>";
            // At end: show key, value and path
            for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                $p[] = $iterator->getSubIterator($i)->key();
            }
            $path = implode(',', $p);
            saveRow($file_path, $language, $path, '');
        } else {
            for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                $p[] = $iterator->getSubIterator($i)->key();
            }
            $path = implode(',', $p);
            //echo "$k : $v : path -> $path" . PHP_EOL;
            saveRow($file_path, $language, $path, $v);
        }
    }
}

function my_walk_recursive($file_path, $language, array $array, $path = null) {
    foreach ($array as $k => $v) {
        if (!is_array($v)) {
            // http://stackoverflow.com/questions/18447664/get-parent-array-name-after-array-walk-recursive-function
            // leaf node (file) -- print link
            //$fullpath = $path . ' ' . $v;
            // now do whatever you want with $fullpath, e.g.:
            //echo "Link to 0$fullpath\n";

            $id = "0$path";
            $value = $v;
//            echo $file_path . PHP_EOL;
//            echo $language . PHP_EOL;
//            echo $id . PHP_EOL;
//            echo $value . PHP_EOL;
//            echo '-------------------' . PHP_EOL;
            saveRow($file_path, $language, $id, $value);
        }
        else {
            // directory node -- recurse
            my_walk_recursive($file_path, $language, $v, $path.','.$k);
        }
    }
}

function saveRow($path, $language, $id, $text)
{
    $file_name = 'language_file.csv';
    $fp = null;
    if(!file_exists($file_name))
    {
        $fp = fopen($file_name, 'a');
        fputcsv($fp, array('path', 'language', 'id', 'text'));
    }
    if($fp == null)
        $fp = fopen($file_name, 'a');
    $list = array($path, $language, $id, $text);
    fputcsv($fp, $list);
    fclose($fp);
}

//============ parse main ================

$file_name = 'language_file.csv';
if(file_exists($file_name))
    unlink($file_name);

foreach (scan($folder) as $file_path)
{
    $file_data = file_get_contents($file_path);

    $file_data = trim(preg_replace('/\s+/', ' ', $file_data));

    preg_match_all('/eslvid(.*?)\//s', $file_path, $unit);
    //print_r($unit[0]);
    $path = str_replace('/', '', $unit[0][0]);

    preg_match_all('/_(.*?):/s', trim($file_data), $lan);
    //print_r($lan[0]);

    preg_match_all('/\[(.*?);/s', trim($file_data), $array);
    //print_r($array[0]);

    for ($i = 0; $i < count($lan[0]); $i++)
    {
        $args = [];
        $args['path'] = $path;
        $args['language'] = str_replace(":", '', str_replace("_", '', $lan[0][$i]));
        $args['data'] = $array[0][$i];
        analyze($args['path'], $args['language'], $args['data']);
        echo "process path:$path Done" . PHP_EOL;
    }
}
printf("============ Parse Completed =========\n");


