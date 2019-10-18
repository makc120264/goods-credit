$('[id $= pay]').each(function () {
    $(this).datepicker({
        uiLibrary: 'bootstrap4'
    });
});

$('#calculate').on('click', sendData);

function setResultData(result) {
    let data = JSON.parse(result),
        sumPayment = '<p>Оплачено: ' + data.sumPayment + ' денег</p>',
        debt = '<p>Осталось: ' + data.debt + ' денег</p>',
        fine = '';

    if (!data.fine) {
        $('div.bg-info').html(sumPayment + debt);
        if ($('div.bg-info').hasClass('d-none')) {
            $('div.bg-info').toggleClass('d-none');
            $('div.bg-warning').toggleClass('d-none');
        }
    } else {
        fine = '<p>Платеж просрочен на ' + data.fine.days + ' дней</p>';
        fine += '<p>Сумма штрафных санкций составляет ' + data.fine.sumFine + ' денег</p>';
        $('div.bg-info').toggleClass('d-none');
        $('div.bg-warning').html(fine + sumPayment + debt);
        $('div.bg-warning').toggleClass('d-none');
    }
    $('div#result').removeClass('d-none');
}

function sendData() {
    $('div#result').addClass('d-none');
    let data = $('form').serialize();
    $.ajax({
        type: "POST",
        url: "/Classes/Calculator.php",
        data: data,
        success: function (result) {
            setResultData(result);
        }
    });
}

