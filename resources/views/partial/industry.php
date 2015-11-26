<?php
$industryOptions = [
    "Select an industry",
    "Luxury Brands" => [
            "fashion" => "Fashion",
            "leatherGoods" => "Leather Goods",
            "watches" => "Watches",
            "jewellery" => "Jewellery",
            "perfume" => "Perfume",
            "cosmetics" => "Cosmetics (Beauty)",
            "group" => "Group",
            "licence" => "Licence",
            "retail" => "Retail",
            "wineSpirits" => "Wine & Spirits",
            "luxuryBrandsOther" => "Other",
    ],
    "Other Brands" => [
            "affordableLuxury" => "Affordable Luxury",
            "consumerGoods" => "Consumer Goods",
            "otherBrandsOther" => "Other",
    ],
    "Other Luxury" => [
            "hospitality" => "Hospitality",
            "foodBeverages" => "Food & Beverages",
            "design" => "Design",
            "automotive" => "Automotive",
            "aviation" => "Aviation",
            "otherLuxuryOther" => "Other",
    ],
    "Finance" => [
            "advisory" => "Advisory",
            "assetManagement" => "Asset Management",
            "banking" => "Banking",
    ],
    "Strategy" => [
            "strategyConsulting" => "Strategy Consulting",
            "researchInstitute" => "Research Institute",
    ],
    "Marketing" => [
            "communicationPR" => "Communication & PR",
            "advertising" => "Advertising",
            "production" => "Production",
    ],
    "Digital" => [
            "agency" => "Agency",
            "eCommerce" => "e-Commerce",
    ],
    "Other Consulting" => [
            "realEstate" => "Real Estate",
            "law" => "Law",
            "hr" => "HR",
    ],
];
$isSelected = function ($value) use ($selectedValue) {
    if (isset($selectedValue) && $value === $selectedValue) {
        return ' selected="selected"';
    }
    return '';
};

?>
<select name="<?= $fieldName ?>">
    <?php foreach($industryOptions as $group => $options): ?>
        <?php if (is_array($options)): ?>
            <optgroup label="<?= $group ?>">
                <?php foreach($options as $value => $label): ?>
                    <option value="<?= $value ?>"<?= $isSelected($value)?>><?= $label ?></option>
                <?php endforeach ?>
            </optgroup>
        <?php else: ?>
            <option value=""><?= $options ?></option>
        <?php endif ?>
    <?php endforeach ?>
</select>
