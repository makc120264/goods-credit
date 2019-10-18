<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Credit calculator</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body>

        <div class="jumbotron text-center">
            <h1>Credit calculator</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <form class="was-validated" name="">
                        <div class="form-group">
                            <label for="data_pay">Дата платежа:</label>
                            <input type="text" class="form-control" id="data_pay" placeholder="Payment date" name="form[dataPay]" value="02/06/2016" required>
                        </div>
                        <div class="form-group">
                            <label for="сost">Стоимость товара:</label>
                            <input type="text" class="form-control" id="сost" placeholder="Enter сost of goods" name="form[сost]" value="12000" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="first_pay">Дата первого платежа:</label>
                            <input type="text" class="form-control" id="first_pay" placeholder="First payment date" name="form[firstPay]" value="12/05/2015" required>
                        </div>
                        <div class="form-group">
                            <label for="last_pay">Дата последнего платежа по рассрочке:</label>
                            <input type="text" class="form-control" id="last_pay" placeholder="Last payment date" name="form[lastPay]" value="12/05/2016" required>
                        </div>
                        <div class="form-group">
                            <label for="mon_payment">Ежемесячный платеж:</label>
                            <input type="text" class="form-control" id="mon_payment" name="form[monPay]" value="1000">
                        </div>
                        <div class="form-group">
                            <label for="fine">Штраф при просрочке более 7 дней в процентах от суммы ожидаемого платежа за каждый день просрочки:</label>
                            <input type="text" class="form-control" id="fine" name="form[fine]" value="1">
                        </div>
                        <button type="button" id="calculate" class="btn btn-primary">Расчитать</button>
                    </form>
                </div>
                <div id="result" class="col-sm-6 d-none">
                    <h3>Result</h3>
                    <div class="row">
                        <div class="d-flex p-3 bg-secondary text-white">
                            <div class="p-2 bg-info"></div>
                            <div class="p-2 bg-warning d-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/main.js" type="text/javascript"></script>
    </body>
</html>
