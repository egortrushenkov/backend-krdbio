<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>

<dialog class="w-full max-w-72 bg-white text-black rounded-4xl py-10 px-4">
    <div class="flex flex-col items-center text-center">
        <div class="flex items-center justify-center bg-red/20 backdrop-blur-2xl rounded-3xl size-32 mb-6">
            <?php \lib\KitTPL::icon("{id: 'error', className: 'icon text-red text-7xl', data: null}");?>
        </div>
        <h2 class="font-alt font-extrabold uppercase text-3xl">
            Ошибка
        </h2>
        <p class="opacity-70">
            Возникла непредвиденная <br> ошибка
        </p>
    </div>
</dialog>
