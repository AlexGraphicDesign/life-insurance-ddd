<?php

declare(strict_types=1);

namespace Domain\Contract\Model;

use Domain\Common\Model\BaseContract;

class Informations extends BaseContract
{
    public string $number {
        set {
            $this->number = $value;
        }
        get {
            return $this->number;
        }
    }

    public string $subscriberNumber {
        set {
            $this->subscriberNumber = $value;
        }
        get {
            return $this->subscriberNumber;
        }
    }

    public string $coSubscriberNumber {
        set {
            $this->coSubscriberNumber = $value;
        }
        get {
            return $this->coSubscriberNumber;
        }
    }

    public string $insuredNumber {
        set {
            $this->insuredNumber = $value;
        }
        get {
            return $this->insuredNumber;
        }
    }

    public string $coInsuredNumber {
        set {
            $this->coInsuredNumber = $value;
        }
        get {
            return $this->coInsuredNumber;
        }
    }

    public string $arbitrationProgramLabel {
        set {
            $this->arbitrationProgramLabel = $value;
        }
        get {
            return $this->arbitrationProgramLabel;
        }
    }

    public string $transfertCode {
        set {
            $this->transfertCode = $value;
        }
        get {
            return $this->transfertCode;
        }
    }

    public string $programmedPaymentPureBonus {
        set {
            $this->programmedPaymentPureBonus = $value;
        }
        get {
            return $this->programmedPaymentPureBonus;
        }
    }
}
