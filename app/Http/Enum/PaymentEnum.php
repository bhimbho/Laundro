<?php
namespace App\Http\Enum;

enum PaymentEnum:string {
    case CASH = 'cash';
    case CREDIT = 'credit';
    case DEBIT = 'debit';
    case CHEQUE = 'cheque';
    case TRANSFER = 'transfer';
}