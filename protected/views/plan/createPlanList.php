<h2 class="prepend-1">创建生产计划</h2>
<hr>

<div id="createPlanList">
<span class="span-21 last">客户：
<a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a></span>

<span class="span-7">货号：<input type="text" id="J_goodsNumber"></input></span>
<span class="span-14 last">交付日期：<input type="text" id="J_deadLine" class='J_selectTime'></input></span>

<table class="record" id="J_bigTable">
    <tbody>
        <tr>
            <th></th>
            <th></th>
            <th>颜色</th>
            <th>色号</th>
            <th>缸号</th>
            <th>尺码</th>
            <th>件数</th>
            <th>尺码吊线</th>
            <th></th>
            <th></th>
        </tr>
    </tbody>
    <tbody class="J_bigRow">
        <tr>
            <td class="J_rowspan" rowspan="4"><button class="J_addBigRow">添加</button></td>
            <td class="J_rowspan"  rowspan="4"><button class="J_delBigRow">删除</button></td>
            <!-- 颜色  -->
            <td class="J_rowspan"  rowspan="4"><input type="text" class="J_colorName"></input></td>
            <!-- 色号  -->
            <td class="J_rowspan"  rowspan="4"><input type="text" class="J_colorNumber"></input></td>
            <!-- 缸号  -->
            <td class="J_rowspan"  rowspan="4"><input type="text" class="J_gangNumber"></input></td>

        </tr>
        <tr class="J_smallTable" data-id="1">
            <!-- 尺码  -->
            <td class="J_sizeTable"><input type="text"></input></td>
            <!-- 件数  -->
            <td class="J_countTable"><input type="text"></input></td>
            <!-- 尺码吊线  -->
            <td class=""><input type="text"></input></td>
            <td><button class="J_addSmallRow">添加</button></td>
            <td><button class="J_delSmallRow">删除</button></td>
        </tr>
        <tr class="J_smallTable" data-id="2">
            <!-- 尺码  -->
            <td class="J_sizeTable"><input type="text"></input></td>
            <!-- 件数  -->
            <td class="J_countTable"><input type="text"></input></td>
            <!-- 尺码吊线  -->
            <td class=""><input type="text"></input></td>
            <td><button class="J_addSmallRow">添加</button></td>
            <td><button class="J_delSmallRow">删除</button></td>
        </tr>
        <tr class="J_smallTable" data-id="3">
            <!-- 尺码  -->
            <td class="J_sizeTable"><input type="text"></input></td>
            <!-- 件数  -->
            <td class="J_countTable"><input type="text"></input></td>
            <!-- 尺码吊线  -->
            <td class=""><input type="text"></input></td>
            <td><button class="J_addSmallRow">添加</button></td>
            <td><button class="J_delSmallRow">删除</button></td>
        </tr>
    </tbody>
</table>

<table class="record">
    <tbody>
        <tr>
            <th>针型</th>
            <th>部位</th>
            <th></th>
            <th></th>
        </tr>
    </tbody>
    <tbody class="J_SecondRow">        
        <tr class="J_SmallSecondRow" data-id="1">
            <td><input type="text"></input></td>
            <td><input type="text"></input></td>
            <td><button class="J_addSecondRow">添加</button></td>
            <td><button class="J_delSecondRow">删除</button></td>
        </tr>
        <tr class="J_SmallSecondRow" data-id="2">
            <td><input type="text"></input></td>
            <td><input type="text"></input></td>
            <td><button class="J_addSecondRow">添加</button></td>
            <td><button class="J_delSecondRow">删除</button></td>
        </tr>
        <tr class="J_SmallSecondRow" data-id="3">
            <td><input type="text"></input></td>
            <td><input type="text"></input></td>
            <td><button class="J_addSecondRow">添加</button></td>
            <td><button class="J_delSecondRow">删除</button></td>
        </tr>
    </tbody>
</table>

<span id="J_nextId" next-id="4"></span>
<span id="J_nextSecId" nextSec-id="4"></span>
<span id="J_rowspan" rowspan="4"></span>

<table class="hide" id="J_bigRowTemplate" >
    <tbody class="J_bigRow J_template">
        <tr class="J_template">
            <td class="J_rowspan"  rowspan="4"><button class="J_addBigRow">添加</button></td>
            <td class="J_rowspan"  rowspan="4"><button class="J_delBigRow">删除</button></td>
            <!-- 颜色  -->
            <td class="J_rowspan"  rowspan="4"><input type="text" class="J_colorName"></input></td>
            <!-- 色号  -->
            <td class="J_rowspan"  rowspan="4"><input type="text" class="J_colorNumber"></input></td>
            <!-- 缸号  -->
            <td class="J_rowspan"  rowspan="4"><input type="text" class="J_gangNumber"></input></td>
        </tr>
        <tr class="J_smallTable" data-id="">
            <!-- 尺码  -->
            <td class="J_sizeTable"><input type="text"></input></td>
            <!-- 件数  -->
            <td class="J_countTable"><input type="text"></input></td>
            <td><button class="J_addSmallRow">添加</button></td>
            <td><button class="J_delSmallRow">删除</button></td>
        </tr>
        <tr class="J_smallTable" data-id="">
            <!-- 尺码  -->
            <td class="J_sizeTable"><input type="text"></input></td>
            <!-- 件数  -->
            <td class="J_countTable"><input type="text"></input></td>
            <td><button class="J_addSmallRow">添加</button></td>
            <td><button class="J_delSmallRow">删除</button></td>
        </tr>
        <tr class="J_smallTable" data-id="">
            <!-- 尺码  -->
            <td class="J_sizeTable"><input type="text"></input></td>
            <!-- 件数  -->
            <td class="J_countTable"><input type="text"></input></td>
            <td><button class="J_addSmallRow">添加</button></td>
            <td><button class="J_delSmallRow">删除</button></td>
        </tr>
    </tbody>
</table>

<span class="last"><button id="J_saveData">保存全部</button></span>
</div>
<!--客户：
<a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>

货号：<input type="text"></input>
针型：<input type="text"></input>
<table>
    <tbody id="J_bigTable">
        <tr>
            <td></td>
            <td></td>
            <td>颜色</td>
            <td>色号</td>
            <td>缸号</td>
            <td>尺码</td>
            <td>件数</td>
            <td></td>
        </tr>
        <tr class="J_bigRow">
            <td><button class="J_addBigRow" next-id="4">添加</button></td>
            <td><button class="J_delBigRow" next-id="4">删除</button></td>
            <!-- 颜色  --
            <td><input type="text" class="J_colorName"></input></td>
            <!-- 色号  --
            <td><input type="text" class="J_colorNumber"></input></td>
            <!-- 缸号  --
            <td><input type="text" class="J_gangNumber"></input></td>
            <!-- 尺码  --
            <td>
                <table>
                    <tbody class="J_sizeTable">
                        <tr data-id="1">
                            <td><input type="text"></input></td>
                        </tr>
                        <tr data-id="2">
                            <td><input type="text"></input></td>
                        </tr>
                        <tr data-id="3">
                            <td><input type="text"></input></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <!-- 件数  --
            <td>
                <table>
                    <tbody class="J_countTable">
                        <tr data-id="1">
                            <td><input type="text"></input></td>
                        </tr>
                        <tr data-id="2">
                            <td><input type="text"></input></td>
                        </tr>
                        <tr data-id="3">
                            <td><input type="text"></input></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
               <table>
                   <tbody>
                       <tr data-id="1">
                           <td><button class="J_addSmallRow" data-id="1" next-id="4">添加</button></td>
                           <td><button class="J_delSmallRow" data-id="1" next-id="4">删除</button></td>
                       </tr>
                       <tr data-id="2">
                           <td><button class="J_addSmallRow" data-id="2" next-id="4">添加</button></td>
                           <td><button class="J_delSmallRow" data-id="2" next-id="4">删除</button></td>
                       </tr>
                       <tr data-id="3">
                           <td><button class="J_addSmallRow" data-id="3" next-id="4">添加</button></td>
                           <td><button class="J_delSmallRow" data-id="3" next-id="4">删除</button></td>
                       </tr>
                   </tbody>
               </table> 
            </td>
        </tr>
    </tbody>
</table>

<table class="hide">
    <tbody id="J_bigRowTemplate">
        <tr class="J_bigRow J_template">
            <td><button class="J_addBigRow" data-id="" next-id="">添加</button></td>
            <td><button class="J_delBigRow" data-id="" next-id="">删除</button></td>
            <!-- 颜色  --
            <td><input type="text" class="J_colorName"></input></td>
            <!-- 色号  --
            <td><input type="text" class="J_colorNumber"></input></td>
            <!-- 缸号  --
            <td><input type="text" class="J_gangNumber"></input></td>
            <!-- 尺码  --
            <td>
                <table>
                    <tbody>
                        <tr>
                            <td><input type="text"></input></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <!-- 件数  --
            <td>
                <table>
                    <tbody>
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
                           <td><button data-id="" next-id="">添加</button></td>
                           <td><button data-id="" next-id="">删除</button></td>
                       </tr>
                   </tbody>
               </table> 
            </td>
        </tr>
    </tbody>
</table>

<button id="J_test">get data</button>-->
