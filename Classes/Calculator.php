<?php


class Calculator
{
    private $formData;
    private $settlementDatePayment;
    private $maxDelayPayment;
    private $dataPay;
    private $firstPay;
    private $nextPaymentData;

    /**
     * Calculator constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->formData = $this->cleanInput($data);
        $this->settlementDatePayment = '5'; // settlement date of payment (day every month)
        $this->maxDelayPayment = '7'; // maximum delay in payment (day)
        $this->dataPay = getdate(strtotime($this->formData['dataPay']));
        $this->firstPay = getdate(strtotime($this->formData['firstPay']));
    }

    /**
     * @return false|string
     */
    public function calculate()
    {
        $result = [];

        if ($this->dataPay['mday'] <= $this->settlementDatePayment) {
            $result = $this->allRight();
        } else {
            $delayPayment = $this->getDiffDays();
            if ($delayPayment <= $this->maxDelayPayment) {
                $result = $this->allRight();
            } else {
                $result = $this->allBad($delayPayment);
            }
        }

        $this->setNextPaymentData();

        return json_encode($result);
    }

    private function setNextPaymentData()
    {
        if ($this->dataPay['mon'] < 10) {
            $mon = '0' . ($this->dataPay['mon'] + 1);
        } else {
            $mon = $this->dataPay['mon'] + 1;
        }
        $this->nextPaymentData = $mon . '/0' . $this->settlementDatePayment . '/' . $this->dataPay['year'];
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/lastPayment.csv', $this->nextPaymentData); // write the next payment date in the DB
    }

    /**
     * @param $delayPayment
     * @return array
     */
    private function allBad($delayPayment)
    {
        $result['fine']['days'] = $delayPayment;
        $result['fine']['sumFine'] = $delayPayment * ($this->formData['monPay'] * ($this->formData['fine'] / 100));
        $result['sumPayment'] = $this->formData['monPay'];
        $result['debt'] = $this->getDebt() + $result['fine']['sumFine'];

        return $result;
    }

    /**
     * @return int
     */
    private function getDebt()
    {
        $diff = $this->getDiffMon();
        $debt = $this->formData['сost'] - $this->formData['monPay'] * $diff;

        return $debt;
    }

    /**
     * @return int
     */
    private function getDiffDays()
    {
        $strLastPaymentData = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/lastPayment.csv'); // read the date of the last payment from the DB
        if (empty($strLastPaymentData)) {
            $lastPaymentData = strtotime("02/05/2016");
        } else {
            $lastPaymentData = strtotime($strLastPaymentData);
        }

        $datediff = $this->dataPay[0] - $lastPaymentData;

        return floor($datediff / (60 * 60 * 24));
    }

    /**
     * @return int
     */
    private function getDiffMon()
    {
        $yearFirstPay = date('Y', $this->firstPay['0']);
        $yearDataPay = date('Y', $this->dataPay['0']);

        $monthFirstPay = date('m', $this->firstPay['0']);
        $monthDataPay = date('m', $this->dataPay['0']);

        $diff = (($yearDataPay - $yearFirstPay) * 12) + ($monthDataPay - $monthFirstPay);

        return $diff;
    }

    /**
     * @return array
     */
    private function allRight()
    {
        $result['fine'] = false;
        $result['sumPayment'] = $this->formData['monPay'];
        $result['debt'] = $this->getDebt();

        return $result;
    }

    /**
     * @param $data
     * @return array
     */
    private function cleanInput($data)
    {
        $input = json_encode($data);

        $search = array(
            '@<script[^>]*?>.*?</script>@si', // javascript
            '@<[\/\!]*?[^<>]*?>@si', // HTML tags
            '@<style[^>]*?>.*?</style>@siU', // style tags
            '@<![\s\S]*?--[ \t\n\r]*>@', // multi-level comments
            '@select@si',
            '@drop@si',
            '@insert@si',
            '@update@si',
            '@www@si',
            '@http@si',
            '@https@si',
            '@:\/\/@',
        );

        $output = preg_replace($search, '', $input);
        $result = (array)json_decode($output);

        return $result;
    }
}

$calculator = new Calculator($_POST['form']);
echo $calculator->calculate();