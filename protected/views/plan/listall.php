<img src="../../../images/listall.png" class="span-1">
<h2 class="span-4 ">生产计划总览</h2>
<a href="<?php echo $this->baseUrl; ?>/plan/createPlanList" class="span-16 last" id="plus"></a>
<hr>

<div id="J_tabs">
    <ul>
            <li><a href="#J_tab0">正在生产中</a></li>
            <li><a href="#J_tab1">未安排生产</a></li>
            <li><a href="#J_tab2">生产已完成</a></li>
    </ul>

    <div id="J_tab0">
        <table>
           <tbody>
                <tr>
                       <th>货号</th>
                       <th>客户</th>
                       <th>创建时间</th>
                       <th></th>
                       <th></th>
                </tr>

                <?php foreach($list1 as $plan_id=>$product): ?>
                <tr data-plan-id="<?php echo $plan_id; ?>">
                    <td><a class="J_showPlan" href="<?php echo $this->baseUrl; ?>/ajaxPlan/getPlanByPlanId/plan_id/<?php echo $plan_id; ?>/status/1"><?php echo $product['goods_number']; ?></a></td>
                    <td><?php echo $product['client'] ?></td>
                    <td><?php echo $product['create_time'];?></td>
                    <td>
                        <button data-plan-id="<?php echo $plan_id; ?>" class="J_finish">结束</button>
                    </td>
                    <td>
                    </td>
                </tr>
                <?php endforeach;  ?>

           </tbody> 
        </table>
    </div>

    <div id="J_tab1">
        <table>
            <tbody>
                <tr>
                    <th>货号</th>
                    <th>客户</th>
                    <th>创建时间</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($list0 as $plan_id=>$product): ?>
                <tr data-plan-id="<?php echo $plan_id; ?>">
                    <td><a class="J_showPlan" href="<?php echo $this->baseUrl; ?>/ajaxPlan/getPlanByPlanId/plan_id/<?php echo $plan_id; ?>/status/0"><?php echo $product['goods_number']; ?></a></td>
                    <td><?php echo $product['client']; ?></td>
                    <td><?php echo $product['create_time']; ?></td>
                    <td>
                        <button data-plan-id="<?php echo $plan_id; ?>" class="J_shangji">上机</button>
                    </td>
                    <td>
                        <button data-plan-id="<?php echo $plan_id; ?>" class="J_delete">删除</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="J_tab2">
        <table>
            <tbody>
                <tr>
                    <th>货号</th>
                    <th>客户</th>
                    <th>创建时间</th>
                </tr>
                <?php foreach($list2 as $plan_id=>$product): ?>
                <tr data-plan-id="<?php echo $plan_id; ?>">
                    <td><a class="J_showPlan" href="<?php echo $this->baseUrl; ?>/ajaxPlan/getPlanByPlanId/plan_id/<?php echo $plan_id; ?>/status/2"><?php echo $product['goods_number']; ?></a></td>
                    <td><?php echo $product['client']; ?></td>
                    <td><?php echo $product['create_time']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
