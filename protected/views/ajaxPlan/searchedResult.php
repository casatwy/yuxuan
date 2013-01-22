<?php foreach($planList as $plan): ?>

<J_HEADER data-record-id="<?php echo $plan->id; ?>" data-record-type="<?php echo $type; ?>">
    客户名:<?php echo $plan->provider->name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    时间:<?php echo date("Y-m-d H:i:s", $plan->record_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    单号:RC<?php echo $plan->id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    制单人:<?php echo $plan->plan_maker; ?>
</J_HEADER>
<div><img src="<?php echo $this->baseUrl; ?>/images/mediumloading.gif"></img></div>

<?php endforeach; ?>

<?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));
?>
