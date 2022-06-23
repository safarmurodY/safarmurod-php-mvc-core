<?php

namespace Safarmurod\PhpMvcCore;

use Safarmurod\PhpMvcCore\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}