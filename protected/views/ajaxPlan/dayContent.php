<div id="J_dailyPlanTab">
    <ul>
        <?php foreach($productList as $goods_number=>$value): ?>
        <li><a href="#J_<?php echo $goods_number; ?>"><?php echo $goods_number; ?></a></li>
        <li><a href="#J_<?php echo $goods_number; ?>"><?php echo $goods_number; ?></a></li>
        <li><a href="#J_<?php echo $goods_number; ?>"><?php echo $goods_number; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php foreach($productList as $goods_number=>$product): ?>
    <div id="J_<?php echo $goods_number; ?>">
        <table>
            <tbody>
                <tr>
                    <th>颜色/色号</th>
                    <th>尺码</th>
                    <th>今日产量</th>
                    <th>总产量</th>
                    <th>任务数</th>
                    <th>余数</th>
                </tr>
                <tr>
                    <td>红/123</td>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>S</td>
                                </tr>
                                <tr>
                                    <td>M</td>
                                </tr>
                                <tr>
                                    <td>L</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td><input type="text"></input></td>
                                </tr>
                                <tr>
                                    <td><input type="text"></input></td>
                                </tr>
                                <tr>
                                    <td><input type="text"></input></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                </tr>
                                <tr>
                                    <td>30</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>100</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>90</td>
                                </tr>
                                <tr>
                                    <td>80</td>
                                </tr>
                                <tr>
                                    <td>70</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <button>生产结束</button>
        <button>查看出货记录</button>
        <button>查看入库记录</button>
        <button>查看生产历史</button>
    </div>
    <?php endforeach; ?>
</div>
<button>全部保存</button>
