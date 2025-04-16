<?php

// this array i used in ads show blade, and this array i collect all boolean values in all our tables in ads types and orders type to use it in foreach to make simple if the column one of them should display yes if have value display no if not have a value
/*
 البيانات دي بجمعها من كل الجدوال الل عندي للاعلانات علشان انا بستخدمها ف عرض تفاصيل الاعلان علشان انا عامل
 loop
 بشوف لو هي واحده من ال
 array
 دي بعرض نعم او لا
/
*/
return ['has_elevator', 'has_cellar', 'water_supply', 'sewerage_supply', 'electricity_supply', 'furnished','pool','car_entrance','kitchen'];
