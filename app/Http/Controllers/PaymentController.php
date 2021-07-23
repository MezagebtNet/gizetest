<?php

namespace App\Http\Controllers;

use App\Models\BookLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use YenePay\CheckoutHelper;
use YenePay\Models\CheckoutItem;
use YenePay\Models\CheckoutOptions;
use YenePay\Models\CheckoutType;
use YenePay\Models\IPN;

class PaymentController extends Controller
{
    const DELIVERY_FEE_IF_AVAILABLE = 0;
    const VAT_FEE_IF_AVAILABLE = 0;
    const TOT_FEE_IF_AVAILABLE = 0;
    const DISCOUNT_AMOUNT_IF_AVAILABLE = 0;
    const HANDLING_FEE_IF_AVAILABLE = 0;

    const UNIT_PRICE_OF_ITEM = 1;
    const QUANTITY = 1;

    // const Express = "Express";
    // const Cart = "Cart";

    public function index(Request $request)
    {
        // abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $tasks = Task::all();
        // dd($request);
        $paymentStatus = "";
        if ($request->has('Signature')) {

            $order = [];
            $totalAmount = $request->input('TotalAmount');
            $buyerId = $request->input('BuyerId');
            $merchantOrderId = $request->input('MerchantOrderId');
            $merchantId = $request->input('MerchantId');
            $merchantCode = $request->input('MerchantCode');
            $transactionCode = $request->input('TransactionCode');
            $transactionId = $request->input('TransactionId');
            $status = $request->input('Status');
            $currency = $request->input('Currency');
            $signature = str_replace(" ", "+", $request->input('Signature'));
            // $signature = $request->input('Signature');

            $order['TotalAmount'] = $totalAmount;
            $order['BuyerId'] = $buyerId;
            $order['MerchantOrderId'] = $merchantOrderId;
            $order['MerchantId'] = $merchantId;
            $order['MerchantCode'] = $merchantCode;
            $order['TransactionCode'] = $transactionCode;
            $order['TransactionId'] = $transactionId;
            $order['Status'] = $status;
            $order['Currency'] = $currency;
            $order['Signature'] = $signature;

            //TestIPN
            $verifyIPNResponse = $this->verifyIPN($order);

            // dd($verifyIPNResponse);
            // $uri = "https://endpoints.yenepay.com/api/verify/ipn"; //prod
            // $uri = "https://testapi.yenepay.com/api/verify/ipn/"; //sandbox

            // echo $signature;
            // $verifyIPNResponse = Http::acceptJson()->withHeaders([
            //     'Content-Type' => 'application/json',
            // ])->post($uri, [
            //     'totalAmount' => '1.0',
            //     'buyerId' => $buyerId,
            //     'merchantOrderId' => $merchantOrderId,
            //     'merchantId' => $merchantId,
            //     'merchantCode' => $merchantCode,
            //     'transactionCode' => $transactionCode,
            //     'transactionId' => $transactionId,
            //     'status' => $status,
            //     'currency' => 'ETB',
            //     'signature' => $signature,
            // ]);

            // if ($verifyIPNResponse->successful()) {
            if ($verifyIPNResponse) {
                $paymentStatus = "Valid";

            } else {
                $paymentStatus = "Failed";
            }

        }

        return view('website.payment.index')
            ->with('paymentStatus', $paymentStatus);

    }

    public function performPayment()
    {
        // dd('here');
        // require_once base_path() . '/vendor/yenepay/php-sdk/src/CheckoutHelper.php';
        // require_once base_path() . '/vendor/yenepay/php-sdk/src/Models/CheckoutOptions.php';
        // require_once base_path() . '/vendor/yenepay/php-sdk/src/Models/CheckoutItem.php';
        // require_once base_path() . '/vendor/yenepay/php-sdk/src/Models/CheckoutType.php';

        $this->performCheckout();

    }

    public function performCheckout()
    {
        \Log::channel('codecheef')->info('payment process started');
        //GENERATE CHECKOUT URL
        // $sellerCode = "0681"; //"YOUR_YENEPAY_SELLER_CODE"; GIRUM
        $sellerCode = "7754"; //"YOUR_YENEPAY_SELLER_CODE"; ALMAZ
        // $sellerCode = "SB0806"; //"YOUR_YENEPAY_SANDBOX_SELLER_CODE";
        $useSandbox = false;

        $checkoutOptions = new CheckoutOptions($sellerCode, $useSandbox);

        $checkoutOptions->setProcess(CheckoutType::Express); //alternatively you can set this to CheckoutType::Cart if you are including multiple items in a single order

        // These properties are optional
        $successUrl = "http://localhost:8000/user/payment"; //YOUR_PAYMENT_SUCCESS_RETURN_URL";
        $cancelUrl = "http://localhost:8000/user/payment-cancel"; //YOUR_PAYMENT_CANCEL_RETURN_URL";
        $failureUrl = "http://localhost:8000/user/payment-fail"; //YOUR_PAYMENT_FAILURE_RETURN_URL";
        $ipnUrl = "https://1c70d2d9cb68.ngrok.io/user/payment-ipn"; //YOUR_PAYMENT_COMPLETION_NOTIFICATION_URL";

        $checkoutOptions->setSuccessUrl($successUrl);
        $checkoutOptions->setCancelUrl($cancelUrl);
        $checkoutOptions->setFailureUrl($failureUrl);
        $checkoutOptions->setIPNUrl($ipnUrl);
        $checkoutOptions->setMerchantOrderId("1234"); //"UNIQUE_ID_THAT_IDENTIFIES_THIS_ORDER_ON_YOUR_SYSTEM");
        $checkoutOptions->setExpiresAfter("30"); //"NUMBER_OF_MINUTES_BEFORE_THE_ORDER_EXPIRES");

        $checkoutOrderItem = new CheckoutItem("ITEM 1", 1, 1); //("NAME_OF_ITEM_PAID_FOR", UNIT_PRICE_OF_ITEM, QUANTITY);
        $checkoutOrderItem->ItemId = "1"; //"UNIQUE_ID_FOR_THE_ITEM";
        $checkoutOrderItem->DeliveryFee = 0; //DELIVERY_FEE_IF_AVAILABLE;
        $checkoutOrderItem->Tax1 = 0; //VAT_FEE_IF_AVAILABLE;
        $checkoutOrderItem->Tax2 = 0; //TOT_FEE_IF_AVAILABLE;
        $checkoutOrderItem->Discount = 0; //DISCOUNT_AMOUNT_IF_AVAILABLE;
        $checkoutOrderItem->HandlingFee = 0; //HANDLING_FEE_IF_AVAILABLE;

        $checkoutHelper = new CheckoutHelper();
        $checkoutUrl = $checkoutHelper->getSingleCheckoutUrl($checkoutOptions, $checkoutOrderItem);

        \Log::channel('codecheef')->info('payment checkout url generated.');

        return redirect($checkoutUrl);
        // return $checkoutUrl;

    }

    public function verifyIPN($order = [])
    {
        require_once base_path() . '/vendor/yenepay/php-sdk/src/CheckoutHelper.php';
        require_once base_path() . '/vendor/yenepay/php-sdk/src/Models/IPN.php';

        \Log::channel('codecheef')->info('IPN checking started.');

        $ipnModel = new IPN();

        $ipnModel->setUseSandbox(false); //set this to false on production

        //get IPN Data from DB...
        // $json_data = json_decode(file_get_contents('php://input'), true);

        if ($order != []) {

            if (isset($order["TotalAmount"])) {
                $ipnModel->setTotalAmount($order["TotalAmount"]);
            }

            if (isset($order["BuyerId"])) {
                $ipnModel->setBuyerId($order["BuyerId"]);
            }

            if (isset($order["MerchantOrderId"])) {
                $ipnModel->setMerchantOrderId($order["MerchantOrderId"]);
            }

            if (isset($order["MerchantId"])) {
                $ipnModel->setMerchantId($order["MerchantId"]);
            }

            if (isset($order["MerchantCode"])) {
                $ipnModel->setMerchantCode($order["MerchantCode"]);
            }

            if (isset($order["TransactionCode"])) {
                $ipnModel->setTransactionCode($order["TransactionCode"]);
            }

            if (isset($order["TransactionId"])) {
                $ipnModel->setTransactionId($order["TransactionId"]);
            }

            if (isset($order["Status"])) {
                $ipnModel->setStatus($order["Status"]);
            }

            if (isset($order["Currency"])) {
                $ipnModel->setCurrency($order["Currency"]);
            }

            if (isset($order["Signature"])) {
                $ipnModel->setSignature($order["Signature"]);
            }
        }
        $helper = new CheckoutHelper();
        if ($helper->isIPNAuthentic($ipnModel)) {
            \Log::channel('codecheef')->info('IPN is Authentic');

            //Update IPN table
            $book_language = new BookLanguage();
            $book_language->language_name = "IPN Name";
            $book_language->language_native_name = "etst";
            $book_language->language_code = "IPN";

            $book_language->save();

            return true; //'Success!';
        } else {
            \Log::channel('codecheef')->info('IPN check failed.');

            //Log Failed attempt..
            return false; //'Fail';
        }
    }

    public function log()
    {
        Log::info("payment checkout url generated.");

    }
    public function paymentCancel()
    {
        view('website.payment.cancel');
    }
    public function paymentFail()
    {
        view('website.payment.fail');
    }

    public function saveIPNResult(Request $request)
    {

        $book_language = new BookLanguage();
        $book_language->language_name = "IPN Name";
        $book_language->language_native_name = "etst";
        $book_language->language_code = "IPN";

        $book_language->save();
        return response()->json($book_language);

        // dd($request->all());
        // return 1;
    }

}
