<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $cartId
 */

$compositeStub = ($arResult['COMPOSITE_STUB'] ?? 'N') === 'Y';
?>


<div class="cart__blocksumm__line cart__blocksumm__line__header">
	<div class="row">
		<div class="col-6" style="height: 23px;"><span class="cart__blocksumm__label">Товары:</span></div>
		<div class="col-6 text-right" style="height: 23px;"><span class="cart__blocksumm__quantity"><?= $arResult['NUM_PRODUCTS'] ?> шт.</span></div>
	</div>
</div>
<div class="cart__blocksumm__line">
	<div class="row align-items-end">
		<div class="col-6">Итого:</div>
		<div class="col-6 text-right"><span class="cart__blocksumm__summ"><?=$arResult['TOTAL_PRICE']?></span></div>
	</div>
</div>
