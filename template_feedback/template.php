<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
    <div class="contact-form">
<?php
if ($arResult["isFormErrors"] == "Y"):?><?= $arResult["FORM_ERRORS_TEXT"]; ?><?php endif; ?>
<?= $arResult["FORM_NOTE"] ?>
<?php if ($arResult["isFormNote"] != "Y") {
    ?>

    <?= $arResult["FORM_HEADER"] ?>
    <div class="contact-form__head">
        <?php
        if ($arResult["isFormDescription"] == "Y"
            || $arResult["isFormTitle"] == "Y"
            || $arResult["isFormImage"] == "Y") {
            ?>
            <?php
            if ($arResult["isFormTitle"]) {
                ?>
                <div class="contact-form__head-title"><?= $arResult["FORM_TITLE"] ?></div>
                <?php
            } //endif ;

            ?>

            <div class="contact-form__head-text"><?= $arResult["FORM_DESCRIPTION"] ?></div>
            <?php
        } // endif
        ?>
    </div>

    <div class="contact-form__form">
        <div class="contact-form__form-inputs">
            <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'text') {
                    if (is_array($arResult["FORM_ERRORS"])
                        && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):
                        ?><span class="error-fld"
                                title="<?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>"></span>
                    <?php endif; ?>
                    <div class="input contact-form__input">
                        <label class="input__label" for="form_text_<?= $arQuestion["STRUCTURE"][0]['ID'] ?>">
                            <div class="input__label-text"><?= $arQuestion["CAPTION"];
                                if ($arQuestion["REQUIRED"] == "Y"): ?><?= $arResult["REQUIRED_SIGN"]; ?>
                                <?php endif; ?>
                            </div>
                            <?= $arQuestion["HTML_CODE"] ?>
                        </label>
                    </div>
                    <?php
                }
            } ?>
        </div>

        <div class="contact-form__form-message">
            <div class="input">
                <label class="input__label"
                       for="form_text_<?= $arResult["QUESTIONS"]["medicine_message"]["STRUCTURE"][0]['ID'] ?>">

                    <div class="input__label-text">
                        <?= $arResult["QUESTIONS"]["medicine_message"]["CAPTION"] ?>
                    </div>

                    <?= $arResult["QUESTIONS"]["medicine_message"]["HTML_CODE"] ?>
                </label>
            </div>
        </div>

        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку
                персональных
                данных&raquo;.
            </div>
            <input class="form-button contact-form__bottom-button"
                <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?>
                   type="submit" name="web_form_submit"
                   value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == ''
                       ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"/>
        </div>
    </div>
    </div>

    <?= $arResult["FORM_FOOTER"] ?>
    <?php
} //endif (isFormNote)