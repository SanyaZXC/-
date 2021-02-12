<footer id="footer">
    <!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2021</p>
                <p class="pull-right">Sanya</p>
            </div>
        </div>
    </div>
</footer>
<!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>
<script>
    $(document).ready(function(){ // Код может быть выполнен ТОЛЬКО после загрузки HTML
        $(".add-to-cart").click(function () { // Строка отвечает за кнопку "добавить в корзину"
        // Каждая кнопка иеет селектор add-to-cart и на событие (click) выполняем ф-ию
            var id = $(this).attr("data-id"); // Узнаем, какая именно кнопка была нажата
            // data-id, мы добавили атрибут такой, когда генерировали в каталоге

            // Формируем асинхронный запрос
            // ответ будет обрабатывать ф-ия function
            $.post("/cart/addAjax/"+id, {}, function (data) {
                // обновляем содержимое блока с id #cart-count
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>
</body>

</html>