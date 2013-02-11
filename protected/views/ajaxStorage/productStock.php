<div class="J_item">
    <span class="span-7">色号:
        <select class="J_colorNumber">
            <?php foreach($attributeList['color_number'] as $color_number): ?>
            <option value ="<?php echo $color_number; ?>"><?php echo $color_number; ?></option>
            <?php endforeach; ?>
        </select>
    </span>
    <span class="span-8 last">颜色:
        <select class="J_colorName">
            <?php foreach($attributeList['color_name'] as $color_name): ?>
            <option value ="<?php echo $color_name; ?>"><?php echo $color_name; ?></option>
            <?php endforeach; ?>
        </select>
    </span>
    <span class="span-7">缸号:
        <select class="J_gangNumber">
            <?php foreach($attributeList['gang_number'] as $gang_number): ?>
            <option value ="<?php echo $gang_number; ?>"><?php echo $gang_number; ?></option>
            <?php endforeach; ?>
        </select>
    </span>
    <span class="span-8 last">尺码:
        <select class="J_size">
            <?php foreach($attributeList['size'] as $size): ?>
            <option value ="<?php echo $size; ?>"><?php echo $size; ?></option>
            <?php endforeach; ?>
        </select>
    </span>
    <span class="span-7">重量:<input class="J_weight" type="text"></input></span>
    <span class="span-8 last">针型:<span class="J_needleType"><?php echo $attributeList['needle_type']; ?></span></span>
    <span class="span-15 last">件数:<input class="J_count" type="text"></input></span>
    <span class="prepend-10 span-5 last"><button>删除</button></span>
</div>
