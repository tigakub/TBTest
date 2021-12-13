<?php
$ijson = file_get_contents('php://input');
$idict = json_decode($ijson);

$ename=$idict['PARTICLE_EVENT_NAME'];
$l1v=$idict['led_1_voltage'];
$l2v=$idict['led_2_voltage'];
$l3v=$idict['led_3_voltage'];
$l4v=$idict['led_4_voltage'];
$l5v=$idict['led_5_voltage'];
$l6v=$idict['led_6_voltage'];
$alarm=$idict['alarm_bits'];
$psupply=$idict['power_supply'];
$coreid=$idict['PARTICLE_DEVICE_ID'];
$pubtime=$idict['PARTICLE_PUBLISHED_AT'];
$uid=$idict['PRODUCT_USER_ID'];
$pvers=$idict['PRODUCT_VERSION'];
$ppub=$idict['PARTICLE_EVENT_PUBLIC'];

$tburl = 'https://thingsboard.cloud/api/v1/1nVPRLsj7bhDTGKLOidD/telemetry'

$payload = array(
        'event'=>$ename,
        'voltage1'=>$l1v,
        'voltage2'=>$l2v,
        'voltage3'=>$l3v,
        'voltage4'=>$l4v,
        'voltage5'=>$l5v,
        'voltage6'=>$l6v,
        'alarm_bits'=>$alarm,
        'power_supply'=>$psupply,
        'coreid'=>$coreid,
        'published_at'=>$pubtime,
        'user_id'=>$uid,
        'fw_version'=>$pvers,
        'public'=>$ppub);
$http_opt = array(
        'http'=>array(
                'header'=>"Content-type: application/json\r\n",
                'method'=>'POST',
                'content'=>http_build_query($payload)));

$http_stream = stream_context_create($http_opt);
$post_result = file_get_contents($tburl, false, $context);
echo $post_result;

?>
