<div class="J_item">
    <div class="span-15">
        <span class="span-7">色号:
            <?php if(!empty($attributeList['color_number'])): ?>
            <select class="J_colorNumber">
                <?php foreach($attributeList["color_number"] as $color_number): ?>
                <option value ="<?php echo $color_number; ?>"><?php echo $color_number; ?></option>
                <?php endforeach; ?>
                <option value="input">手工输入</option>
            </select>
            <?php else: ?>
            <input class="J_colorNumber" type="text"></input>
            <?php endif; ?>
            </select>
        </span>
        <span class="span-8 last">颜色:
            <?php if(!empty($attributeList['color_name'])): ?>
            <select class="J_colorName">
                <?php foreach($attributeList["color_name"] as $color_name): ?>
                <option value ="<?php echo $color_name; ?>"><?php echo $color_name; ?></option>
                <?php endforeach; ?>
                <option value="input">手工输入</option>
            </select>
            <?php else: ?>
            <input class="J_colorName" type="text"></input>
            <?php endif; ?>
            </select>
        </span>
    </div>
    <div class="span-15">
        <span class="span-7">缸号:
            <?php if(!empty($attributeList['gang_number'])): ?>
            <select class="J_gangNumber">
                <?php foreach($attributeList["gang_number"] as $gang_number): ?>
                <option value ="<?php echo $gang_number; ?>"><?php echo $gang_number; ?></option>
                <?php endforeach; ?>
                <option value="input">手工输入</option>
            </select>
            <?php else: ?>
            <input class="J_gangNumber" type="text"></input>
            <?php endif; ?>
            </select>
        </span>
        <span class="span-8 last">来料重量:
            <input type="text" class="J_weight"></input>
        </span>
        <span class="span-15 last">实收重量:
            <input type="text" class="J_acturalWeight"></input>
        </span>
            <?php //毛纱的product type ?>
            <input type="hidden" class="J_productType" value="1"></input>
    </div>
    <span class="prepend-10 span-5"><button class="J_deleteRecord">删除</button></span>
</div>
