<?php

// namespace App\Models;

// use Laravel\Sanctum\PersonalAccessToken as SanctumToken;

// class PersonalAccessToken extends SanctumToken
// {
//     protected $connection = 'mongodb'; // Penting
//     protected $collection = 'personal_access_tokens'; // Nama collection MongoDB
// }

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use MongoDB\Laravel\Eloquent\DocumentModel;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use DocumentModel;

    protected $connection = 'mongodb';
    protected $table = 'personal_access_tokens';
    protected $keyType = 'string';
}
