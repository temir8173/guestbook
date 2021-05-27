<?

// 2.
// Оплата заданной суммы с выбором валюты на сайте ROBOKASSA
// Payment of the set sum with a choice of currency on site ROBOKASSA

// регистрационная информация (логин, пароль #1)
// registration info (login, password #1)
$mrh_login = "shaqirukz";
$mrh_pass1 = "Subf06x6r9fVYWnqmka1";

// номер заказа
// number of order
$inv_id = 1;

// описание заказа
// order description
$inv_desc = "ROBOKASSA Advanced User Guide";

// сумма заказа
// sum of order
$out_summ = "8.96";

// тип товара
// code of goods
$shp_item = "2";

// предлагаемая валюта платежа
// default payment e-currency
$in_curr = "";

// язык
// language
$culture = "ru";

// формирование подписи
// generate signature
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");

// форма оплаты товара
// payment form
print "<html>".
      "<form action='https://auth.robokassa.ru/Merchant/Index.aspx' method=POST>".
      "<input type=hidden name=MerchantLogin value=$mrh_login>".
      "<input type=hidden name=OutSum value=$out_summ>".
      "<input type=hidden name=InvId value=$inv_id>".
      "<input type=hidden name=Description value='$inv_desc'>".
      "<input type=hidden name=SignatureValue value=$crc>".
      "<input type=hidden name=Shp_item value='$shp_item'>".
      "<input type=hidden name=IncCurrLabel value=$in_curr>".
      "<input type=hidden name=Culture value=$culture>".
      "<input type=submit value='Pay'>".
      "</form></html>";
?>

<script type="text/javascript" src="https://auth.robokassa.kz/Merchant/PaymentForm/FormSS.js?MerchantLogin=shaqirukz&InvoiceID=0&Culture=ru&Encoding=utf-8&OutSum=5000.00&Receipt=%7B%22items%22:%5B%7B%22name%22:%22%D0%9F%D1%80%D0%B8%D0%B3%D0%BB%D0%B0%D1%81%D0%B8%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D1%8B%D0%B9%22,%22quantity%22:1,%22sum%22:5000,%22tax%22:%22none%22%7D%5D%7D&SignatureValue=bfdcfae1db8d68f92eb4a149ca13496d"></script>