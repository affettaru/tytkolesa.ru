<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<section>
          
                    <div class="cart">
                        <div class="cart__empty">
                            <div class="cart__empty__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/img-cart.png" alt="" /></div>
                            <div class="h2">Ваша корзина пуста!</div>
                            <div class="cart__empty__content">
                                <p>Нажмите здесь, чтобы продолжить покупки</p>
                            </div><a class="mbtn mbtn__big mbtn__primary" href="/">На главную</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!-- <div class="bx-sbb-empty-cart-container">
	<div class="bx-sbb-empty-cart-image">
		<img src="" alt="">
	</div>
	<div class="bx-sbb-empty-cart-text"><?=Loc::getMessage("SBB_EMPTY_BASKET_TITLE")?></div>
	<?
	if (!empty($arParams['EMPTY_BASKET_HINT_PATH']))
	{
		
		?>
		<div class="bx-sbb-empty-cart-desc">
			<?=Loc::getMessage(
				'SBB_EMPTY_BASKET_HINT',
				[
					'#A1#' => '<a href="'.$arParams['EMPTY_BASKET_HINT_PATH'].'">',
					'#A2#' => '</a>',
				]
			)?>
		</div>
		<?
	}
	?>
</div> -->