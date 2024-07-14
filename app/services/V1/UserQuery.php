<?php

namespace App\Services\V1;

use App\Services\ApiFilter;

class UserQuery extends ApiFilter
{
    protected $allowedParams = [
        'firstName' => ['eq'],
        'lastName' => ['eq'],
        'userName' => ['eq'],
        'role' => ['eq'],
        'userType' => ['eq'],
        'status' => ['eq', 'ne'],
        'bannedUntil' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $columnMap = [
        'firstName' => "first_name",
        'lastName' => "last_name",
        'userName' => 'user_name',
        'userType' => "user_type",
        'bannedUntil' => 'banned_until',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];
}
