<?php

function user($p)
{
    return auth()->user() ? auth()->user()->$p : null;
}

function rn()
{
    return request()->route()->getName();
}

function rs($length = 10) {
    return substr(str_shuffle(str_repeat($x='123456789ABCDEFGHJKLMNPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function short($string, $n=100)
{
    $string = strip_tags($string);
    return strlen($string) > $n ? mb_substr($string, 0, $n).'...' : $string;
}

function master()
{
    $user = auth()->user();
    return $user && $user->type == 'master';
}

function upload($new_file, $old_file=null)
{
    delete_file($old_file);
    if ($new_file) {
        $relarive_path = "storage/app/public";
        $file_name = random_sha(20) . '.' . $new_file->getClientOriginalExtension();
        $result = $new_file->move(base_path($relarive_path),$file_name);
        return 'storage/' . $file_name;
    }else {
        return null;
    }
}

function delete_file($income)
{
    $files = is_array($income) ? $income : [$income];
    foreach ($files as $file) {
        if ($file && file_exists($file)) {
            \File::delete($file);
        }
    }
}

function random_sha($l=10)
{
	return substr(md5(rand()), 0, $l);
}


function random_rgba($opacity=null)
{
    $opacity = $opacity ?? rand(0,10)/10;
    return "rgba(".rand(1,255).", ".rand(1,255).", ".rand(1,255).", $opacity)";
}

function urf($input){
    return str_replace(' ', '-', $input);
}

function raw($input){
    return str_replace('-', ' ', $input);
}

function class_name($string)
{
    $class = str_replace('_', '', ucwords($string, '_'));;
    return "App\\$class";
}

function liked($otype, $oid)
{
    if ($user = auth()->user()) {
        $owner_type = class_name($otype);
        $like = \App\Like::where('owner_type', $owner_type)->where('owner_id', $oid)->where('liker_id', $user->id)->first();
        return $like;
    }else {
        return false;
    }
}

function prepare_multiple($inputs)
{
    $result = [];
    foreach ($inputs as $key => $array) {
        if(is_array($array) && count($array)){
            foreach ($array as $i => $value) {
                $result[$i][$key] = $value;
            }
        }
    }
    return $result;
}

function update_filling_session($question)
{
    $filling = session('filling');
    $filling['question_id'] = $question->id;
    session(compact('filling'));
}


function human_time($tatal_seconds, $display_seconds=true)
{
    $seconds = $tatal_seconds % 60;
    $minutes = floor($tatal_seconds / 60);
    $output = $minutes > 0 ? $minutes.' '.__('MINUTE') : '';
    if ($minutes && $seconds && $display_seconds) {
        $output .= __('AND');
    }
    if (!$minutes || $display_seconds) {
        $output .= $seconds > 0 ? $seconds.' '.__('SECOND') : '';
    }
    return $output;
}

function parray($array)
{
    if (is_array($array)) {
        $count = count($array);
        $output = "[";
        for ($i=0; $i < $count ; $i++) {
            $value = $array[$i];
            if (is_int($value)) {
                $output .= $value;
            }else {
                $output .= "'$value'";
            }
            if ($i != $count-1) {
                $output .= ",";
            }
        }
        $output .= "]";
        return $output;
    }else {
        return "[]";
    }
}


function user_types()
{
    return ['code_amooz', 'student', 'admin'];
}
