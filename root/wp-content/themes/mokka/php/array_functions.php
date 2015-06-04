<?php
function projects_item($id, $title, $date, $location, $description)
{
    if($title == null) $title = "";
    if($date == null) $date = "";
    if($location == null) $location = "";
    if($description == null) $description = "";
    return array("id" => $id, "title" => $title, "date" => $date, "location" => $location, "description" => $description);
}

function events_item($id, $title, $date, $location, $description)
{
    if($title == null) $title = "";
    if($date == null) $date = "";
    if($location == null) $location = "";
    if($description == null) $description = "";
    return array("id" => $id, "title" =>$title, "date" => $date, "location" => $location, "description" =>$description);
}

function news_item($date, $img, $name, $reaction)
{
    if($date == null) $date = "";
    if($img == null) $img = "";
    if($name == null) $name = "";
    if($reaction == null) $reaction = "";
    return array("date" => $date, "img" => $img, "name" => $name, "reaction" => $reaction);
}

function ads_item($id,$img, $name, $date, $description)
{
    if($img == null) $img = "";
    if($name == null) $name = "";
    if($date == null) $date = "";
    if($description == null) $description = "";
    return array("id" => $id,"img" => $img, "name" => $name, "date" => $date, "description" => $description);
}

function articles_item($id, $name, $date, $category, $description)
{
    if($name == null) $name = "";
    if($date == null) $date = "";
    if($category == null) $category = "";
    if($description == null) $description = "";
    return array("id" => $id,"name" => $name, "date" => $date, "category" => $category, "description" => $description);
}

function articles_item_full($id, $title, $description, $date, $user, $category)
{
    if($id == null) $id = "";
    if($title == null) $title = "";
    if($description == null) $description = "";
    if($date == null) $date = "";
    if($user == null) $user = "";
    if($category == null) $category = "";
    return array($id, $title, $description, $date, $user, $category);
}

function comments_item($date, $img, $name, $reaction)
{
    if($date == null) $date = "";
    if($img == null) $img = "";
    if($name == null) $name = "";
    if($reaction == null) $reaction = "";
    return array("date" => $date, "img" => $img, "name" => $name, "reaction" => $reaction);
}

function foto_item($id, $url, $delete)
{
    if($id == null) $id = -1;
    if(empty($url)) $url = "temp.jpg";
    return array($id,$url,$delete);
}

function gebruiker_item($id,$username)
{
    if($username == null) $username = "";
    return array($id,$username);
}

function gebruiker_item_full($city, $user, $date, $bio, $photo)
{
    if($city == null) $city = "";
    if($user == null) $user = "";
    if($date == null) $date = "";
    if($bio == null) $bio = "";
    if($photo == null) $photo = "";
    return array($city,$user, $date, $bio, $photo);
}

function project_detail($id, $title, $description, $date, $time, $city, $street, $website, $name, $category){
    if($title == null) $title = "";
    if($description == null) $description = "";
    if($date == null) $date = "";
    if($time == null) $time = "";
    if($city == null) $city = "";
    if($street == null) $street = "";
    if($website == null) $website = "";
    if($name == null) $name = "";
    if($category == null) $category = "";
    return array("id" => $id, "title" => $title, "description" => $description, "date" => $date, "time" =>$time, "city" => $city, "street" => $street, "website" => $website, "name" => $name, "category" => $category);
}

function event_details($id,$title,$gebruikersnaam,$startdate,$enddate,$starttime,$location,$category,$website,$description)
{
    if($title == null) $title = "";
    if($gebruikersnaam == null) $gebruikersnaam = "";
    if($startdate == null) $startdate = "";
    if($enddate == null) $enddate = "";
    if($starttime == null) $starttime = "";
    if($location == null) $location = "";
    if($category == null) $category = "";
    if($website == null) $website = "";
    if($description == null) $description = "";
    return array($id,$title,$gebruikersnaam,$startdate,$enddate,$starttime,$location,$category,$website,$description);
}

function citysList($id, $city){
    if($city == null) $city = "";
    return array("id" => $id, "city" => $city);
}

function project_category_item($id, $name)
{
    if($name == null) $name = "";
    return array("id" => $id,"name" => $name);
}

function event_category_item($id, $name)
{
    if($name == null) $name = "";
    return array("id" => $id,"name" => $name);
}
?>