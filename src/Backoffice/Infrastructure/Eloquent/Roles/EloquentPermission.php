<?php

namespace Src\Backoffice\Infrastructure\Eloquent\Roles;

use Src\Shared\Infrastructure\Persistence\EloquentModel;

class EloquentPermission extends EloquentModel
{
    protected $table      = 'permissions';
    protected $primaryKey = 'value';
    protected $keyType    = 'string';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ['name'];
}