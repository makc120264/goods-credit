# goods-credit
При оформлении товара в рассрочку, сумма к оплате делится на равные части на протяжении всего срока рассрочки. 

Вводные данные
Стоимость товара: 12000 грн
Дата первого платежа по рассрочке: 2015-12-05
Дата последнего платежа по рассрочке: 2016-12-05
Ежемесячный платеж: 1000 грн
Последний платеж: 2016-02-06 (до этого, включительно, платежи были в срок)
Оплата должна происходить до 5-го числа каждого месяц

Штраф по оплате начисляется, если оплата произведена позже 7 дней от назначенной даты, и равен 1% от ожидаемого платежа за день просрочки.

Задание
Реализовать функцию у которой в качестве аргумента должна быть дата нового платежа, а возвращать функция должна массив содержащий в себе информацию:
Есть ли штраф
Кол-во дней просрочки
Сумма штрафа
Какая сумма оплачена
Какая задолженность осталась

Протестировать работу функции на датах нового платежа:
2016-03-05
2016-03-12
2016-03-15
2016-04-05
2016-06-17


При изменении вводных данных: Стоимость товара, Дата первого платежа, Дата последнего платежа по рассрочке функция должна работать корректно
