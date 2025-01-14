<div class="product-list">
    <form method="GET" action="">
        <?php foreach ($arParams["FILTER_PROPERTY_CODE"] as $propertyCode): ?>
            <label>
                <?php echo htmlspecialchars($propertyCode); ?>:
                <select name="<?php echo htmlspecialchars($propertyCode); ?>">
                    <option value="">Все</option>
                    <?php
                    $propertyEnum = \CIBlockPropertyEnum::GetList([], ["CODE" => $propertyCode, "IBLOCK_ID" => $arParams["IBLOCK_ID"]]);
                    while ($enumFields = $propertyEnum->GetNext()) {
                        $selected = isset($_GET[$propertyCode]) && $_GET[$propertyCode] == $enumFields['ID'] ? 'selected' : '';
                        echo '<option value="' . $enumFields['ID'] . '" ' . $selected . '>' . htmlspecialchars($enumFields['VALUE']) . '</option>';
                    }
                    ?>
                </select>
            </label>
        <?php endforeach; ?>
        <button type="submit">Применить фильтр</button>
    </form>

    <ul>
        <?php foreach ($arResult["PRODUCTS"] as $product): ?>
            <li>
                <a href="<?php echo htmlspecialchars($product['URL']); ?>"><?php echo htmlspecialchars($product['NAME']); ?></a>
                <p>Цена: <?php echo htmlspecialchars($product['PRICE']); ?> руб.</p>
                <p>Количество: <?php echo htmlspecialchars($product['QUANTITY']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>