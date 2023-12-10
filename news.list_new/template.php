<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div id="barba-wrapper">
<div class="news-list article-list">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                <a class="article-item article-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                   href="<?= $arItem["DETAIL_PAGE_URL"] ?>" data-anim="anim-3">
                    <div class="article-item__background">
                        <img
                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                        />
                    </div>
                    <div class="article-item__wrapper">
                        <div class="article-item__title">
                            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                                <b><? echo $arItem["NAME"] ?></b><br/>
                            <? endif; ?>
                        </div>
                        <div class="article-item__content">
                            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                <? echo $arItem["PREVIEW_TEXT"]; ?>
                            <? endif; ?>
                        </div>
                        <?foreach($arItem["FIELDS"] as $code=>$value):?>
                            <small>
                                <?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
                            </small><br />
                        <?endforeach;?>

                        <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                            <small>
                                <?=$arProperty["NAME"]?>:&nbsp;
                                <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                                    <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
                                <?else:?>
                                    <?=$arProperty["DISPLAY_VALUE"];?>
                                <?endif?>
                            </small><br />
                        <?endforeach;?>
                    </div>
                </a>
            <? else: ?>
                <p class="article-item article-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                   data-anim="anim-3">
                    <div class="article-item__background">
                        <img
                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                        />
                    </div>
                    <div class="article-item__wrapper">
                        <div class="article-item__title">
                            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                                <b><? echo $arItem["NAME"] ?></b><br/>
                            <? endif; ?>
                        </div>
                        <div class="article-item__content">
                            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                <? echo $arItem["PREVIEW_TEXT"]; ?>
                            <? endif; ?>
                        </div>
                        <?foreach($arItem["FIELDS"] as $code=>$value):?>
                            <small>
                                <?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
                            </small><br />
                        <?endforeach;?>

                        <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                            <small>
                                <?=$arProperty["NAME"]?>:&nbsp;
                                <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                                    <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
                                <?else:?>
                                    <?=$arProperty["DISPLAY_VALUE"];?>
                                <?endif?>
                            </small><br />
                        <?endforeach;?>
                    </div>
                </p>
            <? endif; ?>
        <? endif ?>
    <? endforeach; ?>

    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
</div>
</div>