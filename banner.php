<?php

header('Content-Type: image/*');

require_once("classes/Crud.php");
require_once("classes/VisitorInfo.php");

$visitorInfo = new VisitorInfo();
$ipAddress = $visitorInfo->getIPAddress();
$pageUrl = $visitorInfo->getPageUrl();
$userAgent = $visitorInfo->getUserAgent();
$image = $visitorInfo->getImage();

readfile('assets/images/' . $image);

if ($ipAddress && $pageUrl && $userAgent) {
    $crud = new Crud();
    $userBannerViews = $crud->getData("SELECT * FROM visit_history WHERE `ip_address` = '$ipAddress' AND `user_agent` = '$userAgent' AND `page_url` = '$pageUrl' LIMIT 1");
    if (!$userBannerViews) {
        $dataArray = [':ip_address' => $ipAddress, ':user_agent' => $userAgent, ':page_url' => $pageUrl, ':views_count' => 1];
        $crud->create('INSERT INTO visit_history (ip_address, user_agent, view_date,page_url,views_count) VALUES (:ip_address, :user_agent, now(),:page_url,:views_count)', $dataArray);
    } else {
        $crud->update("UPDATE `visit_history` SET `view_date` = now(),`views_count` = `views_count` + 1 WHERE `ID` =:id ", $userBannerViews->id);
    }
}

?>