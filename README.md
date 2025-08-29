# VNPay SDK for Laravel framework (Only Vietnam Support)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tringuyenduc2903/vnpayvietnam-laravel.svg?style=flat-square)](https://packagist.org/packages/tringuyenduc2903/vnpayvietnam-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tringuyenduc2903/vnpayvietnam-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tringuyenduc2903/vnpayvietnam-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tringuyenduc2903/vnpayvietnam-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tringuyenduc2903/vnpayvietnam-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tringuyenduc2903/vnpayvietnam-laravel.svg?style=flat-square)](https://packagist.org/packages/tringuyenduc2903/vnpayvietnam-laravel)

## Installation

You can install the package via composer:

```bash
composer require tringuyenduc2903/vnpayvietnam-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="vnpayvietnam-config"
```

This is the contents of the published config file:

```php
return [
    'url' => env('VNPAY_API_URL', 'https://sandbox.vnpayment.vn'),
    'tmn_code' => env('VNPAY_TMN_CODE', ''),
    'hash_secret' => env('VNPAY_HASH_SECRET', ''),
];
```

#### Giải thích

- **url**: Môi trường phát triển tích hợp (**Sandbox**: https://sandbox.vnpayment.vn)
- **tmn_code**: Terminal ID / Mã Website
- **hash_secret**: Secret Key / Chuỗi bí mật tạo checksum

#### File .env:

```dotenv
VNPAY_API_URL=https://sandbox.vnpayment.vn
VNPAY_TMN_CODE=
VNPAY_HASH_SECRET=
```

## Usage

### [Tạo URL Thanh toán](https://sandbox.vnpayment.vn/apis/docs/thanh-toan-pay/pay.html#tao-url-thanh-toan)

```php
use BeetechAsia\VNPay\Enums\OrderType;use BeetechAsia\VNPay\Facades\VNPay;

$data = [
    'vnp_Amount' => 843_035,
    'vnp_IpAddr' => '10.100.0.1',
    'vnp_OrderInfo' => 'Description',
    'vnp_OrderType' => OrderType::FOOD_CONSUMPTION,
    'vnp_ReturnUrl' => 'https://example.com/return',
    'vnp_ExpireDate' => now('Asia/Ho_Chi_Minh')->addMinutes(10)->format('YmdHis'),
    'vnp_TxnRef' => 'b663e2c8-ed95-34bb-b7e7-355c7121d3a8',
];
VNPay::createPaymentUrl($data);
```

### Danh sách Ngân hàng (vnp_BankCode)

```php
use BeetechAsia\VNPay\Facades\VNPay;

VNPay::getBankCodes();
```

### [Cài đặt Code IPN URL](https://sandbox.vnpayment.vn/apis/docs/thanh-toan-pay/pay.html#code-ipn-url)

```php
use BeetechAsia\VNPay\Facades\VNPay;

$order_id = '9d8849ec-ed01-3324-83d1-85b61484412f'; // Mã tham chiếu của giao dịch tại hệ thống
$order_amount = 843_035; // Số tiền thanh toán
$check_updated_order_callback = fn(): bool => false // Closure kiểm tra trạng thái xác nhận giao dịch tại hệ thống
$update_order_callback = function () { } // Closure thực hiện cập nhật trạng thái xác nhận giao dịch tại hệ thống
$handle = VNPay::handleIpn(
    $order_id,
    $order_amount,
    $check_updated_order_callback,
    $update_order_callback,
);
```

### [Truy vấn kết quả thanh toán](https://sandbox.vnpayment.vn/apis/docs/truy-van-hoan-tien/querydr&refund.html#truy-van-ket-qua-thanh-toan-PAY)

```php
use BeetechAsia\VNPay\Facades\VNPay;

$data = [
    'vnp_RequestId' => 1,
    'vnp_TxnRef' => 'b663e2c8-ed95-34bb-b7e7-355c7121d3a8',
    'vnp_OrderInfo' => 'Description',
    'vnp_TransactionDate' => '20250828132325',
    'vnp_IpAddr' => '10.100.0.1',
];
VNPay::getPaymentResult($data);
```

### [Giao dịch hoàn tiền](https://sandbox.vnpayment.vn/apis/docs/truy-van-hoan-tien/querydr&refund.html#hoan-tien-thanh-toan-PAY)

```php
use BeetechAsia\VNPay\Facades\VNPay;
use BeetechAsia\VNPay\Enums\RefundTransactionType;

$data = [
    'vnp_RequestId' => 1,
    'vnp_TransactionType' => RefundTransactionType::FULL,
    'vnp_TxnRef' => 'b663e2c8-ed95-34bb-b7e7-355c7121d3a8',
    'vnp_Amount' => 843_035,
    'vnp_OrderInfo' => 'Description',
    'vnp_TransactionDate' => '20250828132325',
    'vnp_CreateBy' => 'NGUYEN VAN A',
    'vnp_IpAddr' => '10.100.0.1',
];
VNPay::sendRefundRequest($data);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](https://github.com/tringuyenduc2903/VNPayVietNam-Laravel/security/policy) on how to
report security vulnerabilities.

## Credits

- [Tri Nguyen Duc (Bee Tech - PHP)](https://github.com/tringuyenduc2903)
- [All Contributors](https://github.com/tringuyenduc2903/VNPayVietNam-Laravel/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
