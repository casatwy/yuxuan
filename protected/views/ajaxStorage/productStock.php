<div class="J_item">
    <div class="span-15">

        <span class="span-7">色号:
            <?php if(!empty($attributeList['color_number'])): ?>
            <select class="J_colorNumber">
                <?php foreach($attributeList['color_number'] as $color_number): ?>
                <option value ="<?php echo $color_number; ?>"><?php echo $color_number; ?></option>
                <?php endforeach; ?>
                <?php /*
                <option value="input">手工输入</option>
                */?>
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
                <?php /*
                <option value="input">手工输入</option>
                */?>
            </select>
            <?php else: ?>
            <input class="J_colorName" type="text"></input>
            <?php endif; ?>
        </span>
        <span class="span-8 last">缸号:
            <?php if(!empty($attributeList['gang_number'])): ?>
            <select class="J_gangNumber">
                <?php foreach($attributeList['gang_number'] as $gangNumber): ?>
                <option value ="<?php echo $gangNumber; ?>"><?php echo $gangNumber; ?></option>
                <?php endforeach; ?>
                <?php /*
                <option value="input">手工输入</option>
                */?>
            </select>
            <?php else: ?>
            <input class="J_gangNumber" type="text"></input>
            <?php endif; ?>
        </span>
    </div>

    <div class="span-15">
        <span class="span-7">尺码:
            <?php if(!empty($attributeList['size'])): ?>
            <select class="J_size">
                <?php foreach($attributeList['size'] as $size): ?>
                <option value ="<?php echo $size; ?>"><?php echo $size; ?></option>
                <?php endforeach; ?>
                <?php /*
                <option value="input">手工输入</option>
                */?>
            </select>
            <?php else: ?>
            <input class="J_size" type="text"></input>
            <?php endif; ?>
        </span>
        <span class="span-8 last">吊线:
            <?php if(!empty($attributeList['diaoxian'])): ?>
            <select class="J_diaoxian">
                <?php foreach($attributeList['diaoxian'] as $diaoxian): ?>
                <option value ="<?php echo $diaoxian; ?>"><?php echo $diaoxian; ?></option>
                <?php endforeach; ?>
                <?php /*
                <option value="input">手工输入</option>
                */?>
            </select>
            <?php else: ?>
            <input class="J_diaoxiao" type="text"></input>
            <?php endif; ?>
        </span>
    </div>

    <div class="span-15">
        <span class="span-7">成品重量:
            <input class="J_weight" type="text"></input>
        </span>
        <span class="span-8 last">生产种类:
            <?php if(!empty($attributeList['product_type'])): ?>
            <select class="J_productType">
                <?php foreach($attributeList['product_type'] as $productPart): ?>
                <option value ="<?php echo $productPart->id; ?>"><?php echo $productPart->part_name."(针型:".$productPart->needle_type.")"; ?></option>
                <?php endforeach; ?>
                <?php /*
                <option value="input">手工输入</option>
                 */ ?>
            </select>
            <?php else: ?>
            <input class="J_productType" type="text"></input>
            <?php endif; ?>
        </span>
    </div>

    <div class="span-15">
        <span class="span-7">件数:
            <input class="J_count" type="text"></input>
        </span>
    </div>

    <span class="prepend-10 span-5 last"><button class="J_deleteRecord">删除</button></span>
</div>
