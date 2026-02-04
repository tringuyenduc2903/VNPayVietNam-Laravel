# Changelog

All notable changes to `VNPayVietNam-Laravel` will be documented in this file.

## Release v2.0.0 - VNPay SDK for Laravel - 2025-08-29

This major release of the VNPayVietNam-Laravel SDK introduces significant enhancements to the payment integration for Laravel applications, focusing on flexibility, developer experience, and alignment with VNPay's API standards. The most notable change is the update to the `createPaymentUrl` method, which now returns a `string` instead of a `RedirectResponse`, providing greater control for developers to handle payment URL redirection as needed. This release also includes expanded documentation, updated tests, and improved configuration handling for seamless integration with VNPay's payment gateway in Vietnam.

### Key Changes

* **Updated `createPaymentUrl` Return Type**: Changed the return type of the `createPaymentUrl` method from `RedirectResponse` to `string`, allowing developers to customize how the payment URL is utilized (e.g., manual redirection or API responses).
* **Enhanced Documentation**: Added detailed explanations and examples in `README.md` for configuration, creating payment URLs, handling IPN, querying payment results, and processing refunds, improving onboarding for developers.
* **Improved Configuration**: Added explicit environment variables (`VNPAY_API_URL`, `VNPAY_TMN_CODE`, `VNPAY_HASH_SECRET`) in the configuration file for better clarity and ease of setup.
* **Updated Tests**: Modified test cases in `PayTest.php` to validate the new `string` return type of `createPaymentUrl`, ensuring reliability and consistency.
* **Bank Code Retrieval**: Added support for retrieving VNPay bank codes via the `getBankCodes` method, enhancing payment option flexibility.
* **IPN and Refund Handling**: Introduced clear examples for handling IPN callbacks and refund requests, streamlining integration with VNPay's transaction processing.
* **Minor Bug Fixes and Optimizations**: Refined internal logic for better performance and compatibility with VNPay's sandbox and production environments.

## Initial Release of VNPayVietNam-Laravel SDK (v1.0.0) - 2025-08-29

We are thrilled to announce the first official release of the VNPayVietNam-Laravel SDK (v1.0.0), designed to seamlessly integrate with the Laravel framework for interacting with the VNPay payment gateway, specifically tailored for Vietnam-based payment processing. This release provides a comprehensive set of tools to facilitate secure and efficient payment operations, including payment initiation, transaction queries, and refund processing, streamlining e-commerce payment workflows.

### Key Features

* **Easy Installation**: Install the SDK via Composer and publish configuration files with a single command.
* **Secure Payment Integration**: Supports secure payment initiation with VNPay’s required parameters, including checksum generation for transaction security.
* **Transaction Management**: Query transaction status, retrieve transaction details, and handle refunds with ease.
* **Configuration Flexibility**: Publishable configuration file to customize VNPay API credentials and settings.
* **Vietnam-Specific Support**: Tailored for Vietnam’s payment ecosystem, supporting local currency (VND) and VNPay’s gateway requirements.
* **Webhook Support**: Verify and handle webhook notifications for real-time transaction updates.
* **Error Handling**: Robust error handling and validation for reliable integration with VNPay’s API.
