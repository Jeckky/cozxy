<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\EPaymentMaster;

/**
 * This is the model class for table "e_payment".
 *
 * @property string $ePaymentId
 * @property string $paymentMethodId
 * @property string $bankId
 * @property string $ePaymentTel
 * @property string $ePaymentMerchantId
 * @property string $ePaymentOrgId
 * @property string $ePaymentUrl
 * @property string $ePaymentAccessKey
 * @property string $ePaymentSecretKey
 * @property string $ePaymentProfileId
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class EPayment extends \common\models\costfit\master\EPaymentMaster
{

    const TYPE_TEST = 1;
    const TYPE_PRODUCTION = 2;
    //E Payment Reason Code
    //Accept Trans.
    const REASON_SUCCESS = 100;
    const REASON_AUTHORIZE_SUCCESS = 110;
    //Review Trans.
    const REVIEW_QUESTION_ABOUT_REQUEST = 201;
    const REVIEW_ADDRESS_FAIL_VERIFY = 200;
    const REVIEW_CARD_VERIFY_NUMBER = 230;
    const REVIEW_SMART_AUTHORIZE = 520;
    //Reject Error Cancel Trans.
    const REJECT_FIELD_MISSING = 102;
    const REJECT_ADDRESS_FAIL_VERIFY = 200;
    const REJECT_CARD_EXPIRED = 202;
    const REJECT_CARD_DECLINED = 203;
    const REJECT_INSUFFICIENT_FUNDS = 204;
    const REJECT_CARD_STOLEN = 205;
    const REJECT_BANK_UNAVAILABLE = 207;
    const REJECT_CARD_INACTIVE = 208;
    const REJECT_CREDIT_LIMIT_REACHED = 210;
    const REJECT_VALIFICATION_NO_INVALID = 211;
    const REJECT_NEGATIVE_FILE = 221;
    const REJECT_ACC_FROZEN = 222;
    const REJECT_CARD_VERIFY_NUMBER = 230;
    const REJECT_ACC_NO_INVALID = 231;
    const REJECT_CARD_TYPE_NOT_ACCEPTED = 232;
    const REJECT_ISSUE_WITH_REQUEST = 233;
    const REJECT_ABOUT_CONFIGURATION = 234;
    const REJECT_PROCESSOR_FAILURE_OCCURRED = 236;
    const REJECT_CARD_TYPE_INVALID = 240;
    const REJECT_CUSTOMER_NOT_AUTHENTICATED = 476;
    const REJECT_PAYER_AUTHENTICATION = 475;
    const REJECT_FROM_BANK_TEST_REVIEW_STUP = 480;
    //ERROR trans.
    const ERROR_GENERAL_SYS_ERR = 150;
    const ERROR_SRV_TIMEOUT_OCCUR = 151;
    const ERROR_SYS_NOT_FINISH_IN_TIME = 152;
    const ERROR_TIMEOUT_PAYMENT_PROCESSOR = 153;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['paymentMethodId' => 'paymentMethodId']);
    }

    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['bankId' => 'bankId']);
    }

    public function getTypeArray()
    {
        return [
            self::TYPE_TEST => "Test",
            self::TYPE_PRODUCTION => "Production",
        ];
    }

    public function getTypeText($type)
    {
        $res = $this->getTypeArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

    public static function getReasonCodeText($reasonCode)
    {
        switch ($reasonCode) {
            case self::REASON_SUCCESS ://User
                return "100 : Successful transaction.";
                break;
            case self::REASON_AUTHORIZE_SUCCESS ://User
                return "110 : Authorization was partially approved.";
                break;
            case self::REVIEW_QUESTION_ABOUT_REQUEST://User
                return "201 : The issuing bank has questions about the request. You cannot receive an authorization code in the
API reply, but you may receive one verbally by calling the processor.
Possible action: Call your processor or the issuing bank to obtain a verbal authorization code. For
contact phone numbers, refer to your merchant bank information.";
                break;
            case self::REVIEW_ADDRESS_FAIL_VERIFY://User
                return "200 : The authorization request was approved by the issuing bank but declined by CyberSource because it
did not pass the Address Verification Service (AVS) check. Possible action: You can capture the authorization, but consider reviewing the order for possible fraud.";
                break;
            case self::REVIEW_CARD_VERIFY_NUMBER://User
                return "230 : The authorization request was approved by the issuing bank but
declined by CyberSource because it
did not pass the card verification number check.";
                break;
            case self::REVIEW_SMART_AUTHORIZE://User
                return "520 : The authorization request was approved by the issuing bank but declined by CyberSource based on
your Smart Authorization settings.
Possible action: Do not capture the authorization without further review. Review the ccAuthReply_
avsCode, ccAuthReply_cvCode, and ccAuthReply_authFactorCode fields to determine why
CyberSource rejected the request.";
                break;
            case self::REJECT_FIELD_MISSING://User
                return "102 : One or more fields in the request are missing or invalid.
Possible action: See the reply fields InvalidField0...N and MissingField0...N for the invalid or
missing fields. Resend the request with the correct information. Important In the other API services, this reason code is split between 101 (missing fields) and 102
(invalid fields).";
                break;
            case self::REJECT_CARD_EXPIRED://User
                return "202 : The card is expired.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CARD_DECLINED://User
                return "203 : The card was declined. No other information was provided by the issuing bank.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_INSUFFICIENT_FUNDS://User
                return "204 : The account has insufficient funds.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CARD_STOLEN://User
                return "205 : The card was stolen or lost.
Possible action: Review the customer’s information to determine if you want to request a different";
                break;
            case self::REJECT_BANK_UNAVAILABLE://User
                return "207 : The issuing bank was unavailable.
Possible action: Wait a few minutes and resend the request.";
                break;
            case self::REJECT_CARD_INACTIVE://User
                return "208 : The card is inactive or not authorized for card-not-present transactions.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CREDIT_LIMIT_REACHED://User
                return "210 : The credit limit for the card has been reached.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_VALIFICATION_NO_INVALID://User
                return "211 : The card verification number is invalid.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_NEGATIVE_FILE://User
                return "221 : The customer matched an entry on the processor’s negative file.
Possible action: Review the order and contact the payment processor.";
                break;
            case self::REJECT_ACC_FROZEN://User
                return "222 : The customer’s bank account is frozen.
Possible action: Review the order or request a different form of payment.";
                break;
            case self::REJECT_CARD_VERIFY_NUMBER://User
                return "230 : The authorization request was approved by the issuing bank but
declined by CyberSource because it did not pass the card verification number check.";
                break;
            case self::REJECT_ACC_NO_INVALID://User
                return "231 : The account number is invalid.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CARD_TYPE_NOT_ACCEPTED://User
                return "232 : The card type is not accepted by the payment processor.
Possible action: Request a different card or other form of payment, and/or check with CyberSource
Customer Support to make sure that your account is configured correctly.";
                break;
            case self::REJECT_ISSUE_WITH_REQUEST://User
                return "233 : The processor declined the request based on an issue with the request itself.
Possible action: Request a different form of payment.";
                break;
            case self::REJECT_ABOUT_CONFIGURATION://User
                return "234 : There is a problem with your CyberSource merchant configuration.
Possible action: Do not resend the request. Contact Customer Support to correct the configuration problem.";
                break;
            case self::REJECT_PROCESSOR_FAILURE_OCCURRED://User
                return "236 : A processor failure occurred. Possible action: Wait a few minutes and resend the request.";
                break;
            case self::REJECT_CARD_TYPE_INVALID://User
                return "240 : The card type sent is invalid or does not correlate with the credit card number.
Possible action: Ask your customer to verify that the card is really the type indicated in your Web store, and resend the request..";
                break;
            case self::REJECT_CUSTOMER_NOT_AUTHENTICATED://User
                return "476 : The customer cannot be authenticated. Possible action: Review the customer's order..";
                break;
            case self::REJECT_PAYER_AUTHENTICATION://User
                return "475 : The customer is enrolled in payer authentication.
Possible action: Authenticate the cardholder before continuing with the transaction.";
                break;
            case self::ERROR_GENERAL_SYS_ERR://User
                return "150 : Error: General system failure. Possible action: Wait a few minutes and resend the request.";
                break;
            case self::ERROR_SRV_TIMEOUT_OCCUR://User
                return "151 : Error: The request was received, but a server time-out occurred.
This error does not include time-outs between the client and the server.
Possible action: To avoid duplicating the order, do not resend the request until you have reviewed the
order status in the Business Center.";
                break;
            case self::ERROR_SYS_NOT_FINISH_IN_TIME://User
                return "152 : Error: The request was received, but a service did not finish running in time.
Possible action: To avoid duplicating the order, do not resend the request until you have reviewed the
order status in the Business Center.";
                break;
            case self::ERROR_TIMEOUT_PAYMENT_PROCESSOR://User
                return "250 : Error: The request was received, but a time-out occurred with the payment processor.
Possible action: To avoid duplicating the transaction, do not resend the request until you have
reviewed the transaction status in the Business Center.";
                break;
            default :
                return $reasonCode . " ไม่มี Reason Code ใน ระบบ กรุณาตรวจสอบกับ ธนาคาร";
                break;
        }
    }

}
