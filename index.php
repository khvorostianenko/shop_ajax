<!DOCTYPE html>
<html lang="en">
 <head>
 <title> Интернет-магазин "Рога и Копыта"
 </title>
     <meta charset="utf-8">
     <link href="styles/style.css" rel="stylesheet">
     <!--Ссылка на jQ Руслана (CTR) -->
     <!--<script type="text/javascript" src="http://yastatic.net/jquery/2.1.4/jquery.min.js"></script>-->
     <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
     <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
     <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <script src="bootstrap/js/bootstrap.min.js"></script>
     <!--<script src="http://malsup.github.com/jquery.form.js"></script>-->
     <script src="js/main.js"></script>
     <script src="js/validate_functions.js"></script>
 </head>
 <body>
 <nav>
    <div class="row">
     <ul id="navb" class="nav navbar-nav col-sm-8 navbar-default" style="margin: auto; display: block; float: none">
         <li class="active">
             <a class="menu" id='main' href="pages/main.php" onClick="forNewDom('pages/main.php')" target="myFrame">Каталог</a></li>
         <li><a class="menu" id='delivery' onClick="forNewDom('pages/delivery.html')" href="pages/delivery.html" target="myFrame">Оплата и доставка</a></li>
         <li><a class="menu" id='clients' onClick="forNewDom('pages/clients.html')" href="pages/clients.html" target="myFrame">Клиентам</a></li>
         <li><a class="menu" id='registration' onClick="forNewDom('pages/registration.html')" href="pages/registration.html" target="myFrame">Регистрация</a></li>
         <li><a class="menu" id='partners' onClick="forNewDom('pages/partners.html')" href="pages/partners.html" target="myFrame">Партнерам</a></li>
         <li><a class="menu" id='about' onClick="forNewDom('pages/about.html')" href="pages/about.html" target="myFrame">О нас</a></li>
         <li><a class="menu" id='contacts' onClick="forNewDom('pages/contacts.html')" href="pages/contacts.html" target="myFrame">Контакты</a></li>
     </ul>
    </div>
 </nav>
<?php
    include_once 'pages/mysql.php';
?>
 <noscript>
     <iframe name="myFrame" src="pages/main.php" align="top" width=100% height=1100px frameborder="2"></iframe>
 </noscript>

 <div id="forReg"></div>
 <main id="main"><div id="for-new-dom"></div></main>
   <footer>
       <p id="fos">
       <div id="forRos"></div>
       <div class="form-group">
           <form action="http://formspree.io/3610974@rambler.ru" novalidate  method="post" target="_blank" id="fos" name="fos">
               <label>Заполните форму и мы ответим на все Ваши вопросы</label><br>
               <label><?=$fail ?></label><br>
               <input type="text" class="form-control" name="forename" placeholder="Ваше имя" <?=$formForname ?><br>
               <input type="email" class="form-control" name="email" placeholder="Укажите email" <?=$formEmail ?><br>
               <textarea name='comment' <?=$formComment ?></textarea><br>
               <button>Отправить</button>
           </form>
       </div>

       </p>
       <br>
       <ul>
           <li>Условия использования</li>
           <li>Конфиденциальность</li>
           <li>Контакты© 2016 All rights reserved</li>
       </ul>

   </footer>

 </body>
</html>
