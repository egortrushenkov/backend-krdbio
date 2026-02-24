<?
	include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404", "Y");

	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

	$APPLICATION->SetTitle("404 Not Found");
?>
    <section class="container flex items-center justify-center grow">
        <div class="flex flex-col items-center text-center">
            <h1 class="font-alt font-extrabold text-[11rem] sm:text-[16rem] lg:text-[20rem] leading-none opacity-20 mb-4 sm:mb-6 lg:mb-8">404</h1>
            <?php \lib\KitTPL::subtitleSmall("{text: 'Страница не найдена...', className: 'mb-4 sm:mb-6 lg:mb-8', data: null}");?>
            <p class="text-sm sm:text-base mb-8">
                Возможно, запрашиваемая вами страница была перенесена <br class="hidden sm:block"> или удалена. Проверьте правильность написания адреса
            </p>
            <a class="btn btn-primary btn-fill btn-light btn-lg" data-waved="light" draggable="false" href="/">На главную</a>
        </div>
    </section>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>