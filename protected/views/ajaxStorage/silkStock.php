<div class="J_item">
    <span class="span-7">色号:
        <select class="J_colorNumber">
            <?php foreach($attributeList["color_number"] as $color_number): ?>
            <option value ="<?php echo $color_number; ?>"><?php echo $color_number; ?></option>
            <?php endforeach; ?>
        </select>
    </span>
    <span class="span-8 last">颜色:
        <select class="J_colorName">
            <?php foreach($attributeList["color_name"] as $color_name): ?>
            <option value ="<?php echo $color_name; ?>"><?php echo $color_name; ?></option>
            <?php endforeach; ?>
        </select>
    </span>
    <span class="span-7">缸号:
        <select class="J_gangNumber">
            <?php foreach($attributeList["gang_number"] as $gang_number): ?>
            <option value ="<?php echo $gang_number; ?>"><?php echo $gang_number; ?></option>
            <?php endforeach; ?>
        </select>
    </span>
    <span class="span-8 last">重量:<input type="text" class="J_weight"></input></span>
    <span class="prepend-10 span-5"><button class="J_deleteRecord">删除</button></span>
</div>
