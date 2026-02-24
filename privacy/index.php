  <?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Политика конфиденциальности");
?>

<?
use lib\Kit;
use Bitrix\Main\Config\Option;
?>

<section class="container">
    <?php \lib\KitTPL::back();?>
    <?php \lib\KitTPL::title("{text: '".$APPLICATION->GetTitle()."', className: 'mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
    <div class="description text-sm sm:text-base">
        <h4>
            1. Общие положения
        </h4>
        <br>
        <p>
            <b>Lorem</b> ipsum dolor sit amet consectetur adipisicing elit. Magni quas iste harum delectus similique provident. Quo deserunt rem veritatis commodi molestiae eum perspiciatis sed, maiores tempora exercitationem aliquid perferendis corrupti?
        </p>
        <br>
        <ul>
            <li>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, quisquam? Ex quisquam sapiente, debitis sed quod provident autem rem, maxime iusto commodi nulla architecto aut aperiam quibusdam. Aut, ab voluptatum?
            </li>
            <li>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, quisquam? Ex quisquam sapiente, debitis sed quod provident autem rem, maxime iusto commodi nulla architecto aut aperiam quibusdam. Aut, ab voluptatum?
            </li>
            <li>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, quisquam? Ex quisquam sapiente, debitis sed quod provident autem rem, maxime iusto commodi nulla architecto aut aperiam quibusdam. Aut, ab voluptatum?
            </li>
        </ul>
        <br>
        <ol>
            <li>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, quisquam? Ex quisquam sapiente, debitis sed quod provident autem rem, maxime iusto commodi nulla architecto aut aperiam quibusdam. Aut, ab voluptatum?
            </li>
            <li>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, quisquam? Ex quisquam sapiente, debitis sed quod provident autem rem, maxime iusto commodi nulla architecto aut aperiam quibusdam. Aut, ab voluptatum?
            </li>
            <li>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, quisquam? Ex quisquam sapiente, debitis sed quod provident autem rem, maxime iusto commodi nulla architecto aut aperiam quibusdam. Aut, ab voluptatum?
            </li>
        </ol>
    </div>
</section>

<?php \lib\KitTPL::map();?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
