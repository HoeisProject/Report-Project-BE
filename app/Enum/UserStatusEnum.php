<?php

namespace App\Enum;

enum UserStatusEnum: int
{
    case ADMIN = 0;
    case NOUPLOAD = 1;
    case PENDING = 2;
    case APPROVE = 3;
    case REJECT = 4;
}
