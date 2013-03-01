<div class="J_item">
    <div class="span-15">
        <span class="span-7">色号:
            <?php if(!empty($attributeList['color_number'])): ?>
            <select class="J_colorNumber">
                <?php foreach($attributeList['color_number'] as $color_number): ?>
                <option value ="<?php echo $color_number; ?>"><?php echo $color_number; ?></option>
                <?php endforeach; ?>
                <option value="input">手工输入</option>
            </select>
            <?php else: ?>
            <input class="J_colorNumber" type="text"></input>
            <?php endif; ?>
        </span>
        <span class="span-8 last">颜色:
            <?php if(!empty($attributeList['color_name'])): ?>
            <select class="J_colorName">
                <?php foreach($attributeList['color_name'] as $color_name): ?>
                <option value ="<?php echo $color_name; ?>"><?php echo $color_name; ?></option>
                <?php endforeach; ?>
                <option value="input">手工输入</option>
            </select>
            <?php else: ?>
            <input class="J_colorName" type="text"></input>
            <?php endif; ?>
        </span>
    </div>
    <div class="span-15">
        <span class="span-8 last">尺码:
            <?php if(!empty($attributeList['size'])): ?>
            <select class="J_size">
                <?php foreach($attributeList['size'] as $size): ?>
                <option value ="<?php echo $size; ?>"><?php echo $size; ?></option>
                <?php endforeach; ?>
                <option value="input">手工输入</option>
            </select>
            <?php else: ?>
            <input class="J_size" type="text"></input>
            <?php endif; ?>
            </select>
        </span>
    </div>
    <div class="span-15">
        <span class="span-7">重量:
            <input class="J_weight" type="text"></input>
        </span>
        <span class="span-8 last">针型:<span class="J_needleType"><?php echo $attributeList['needle_type']; ?></span></span>
    </div>
    <span class="span-15 last">件数:
        <input class="J_count" type="text"></input>
    </span>
    <span class="prepend-10 span-5 last"><button class="J_deleteRecord">删除</button></span>
</div>
