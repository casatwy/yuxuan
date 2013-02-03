<a href="<?php echo $this->baseUrl; ?>/plan/createPlanList">创建生产计划</a>
<br />
<br />
<br />
<div id="J_tabs">
    <ul>
            <li><a href="#J_tab1">正在生产中</a></li>
            <li><a href="#J_tab2">未安排生产</a></li>
            <li><a href="#J_tab3">生产已完成</a></li>
    </ul>

    <div id="J_tab1">
        <table>
           <tbody>
                <tr>
                       <th>货号</th>
                       <th>客户</th>
                       <th>创建时间</th>
                       <th>任务数</th>
                       <th>已完成</th>
                       <th>余数</th>
                       <th></th>
                       <th></th>
                </tr>

                <tr>
                       <td><a href="javascript:void(0);">123456</a></td>
                       <td>casa</td>
                       <td>2013-02-03 14:48:33</td>
                       <td>100</td>
                       <td>90</td>
                       <td>10</td>
                       <td><button>结束</button></td>
                       <td><button>删除</button></td>
                </tr>

                <tr>
                    <td><a href="javascript:void(0);">987654</a></td>
                    <td>yuki</td>
                    <td>2013-02-03 13:44:35</td>
                    <td>100</td>
                    <td>90</td>
                    <td>10</td>
                    <td><button>结束</button></td>
                    <td><button>删除</button></td>
                </tr>
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
                    <th></th>
                </tr>
                <tr>
                    <td><a id="J_goodsNumber" href="javascript:void(0);">123456</a></td>
                    <td>casacasa</td>
                    <td>2013-03-13 06:12:14</td>
                    <td><button>上机</button></td>
                    <td><button>删除</button></td>
                </tr>
                <tr>
                    <td><a id="J_goodsNumber" href="javascript:void(0);">987654</a></td>
                    <td>yukiyuki</td>
                    <td>2013-10-01 12:34:56</td>
                    <td><button>上机</button></td>
                    <td><button>删除</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="J_tab3">
        <table>
            <tbody>
                <tr>
                    <th>货号</th>
                    <th>客户</th>
                    <th>创建时间</th>
                </tr>
                <tr>
                    <td><a id="J_goodsNumber" href="javascript:void(0);">123456</a></td>
                    <td>casacasa</td>
                    <td>2013-03-13 06:12:14</td>
                </tr>
                <tr>
                    <td><a id="J_goodsNumber" href="javascript:void(0);">987654</a></td>
                    <td>yukiyuki</td>
                    <td>2013-10-01 12:34:56</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
