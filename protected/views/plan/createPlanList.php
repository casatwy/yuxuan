客户：
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
            <td><button class="J_addBigRow">添加</button></td>
            <td><button class="J_delBigRow">删除</button></td>
            <!-- 颜色  -->
            <td><input type="text"></input></td>
            <!-- 色号  -->
            <td><input type="text"></input></td>
            <!-- 缸号  -->
            <td><input type="text"></input></td>
            <!-- 尺码  -->
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
            <!-- 件数  -->
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
        <tr class="J_bigRow">
            <td><button class="J_addBigRow">添加</button></td>
            <td><button class="J_delBigRow">删除</button></td>
            <!-- 颜色  -->
            <td><input type="text"></input></td>
            <!-- 色号  -->
            <td><input type="text"></input></td>
            <!-- 缸号  -->
            <td><input type="text"></input></td>
            <!-- 尺码  -->
            <td>
                <table>
                    <tbody>
                        <tr>
                            <td><input type="text"></input></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <!-- 件数  -->
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
