<?php

namespace Src\Backoffice\Infrastructure\Eloquent\Roles;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Shared\Infrastructure\Persistence\EloquentModel;

class EloquentRole extends EloquentModel
{
    protected $table      = 'roles';
    protected $primaryKey = 'id';
    protected $keyType    = 'string';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ['name', 'inmutable'];

    public function permissions(): BelongsToMany
    {
        $pivotTable        = 'roles_permissions';
        $parentPrimaryKey  = 'id';
        $parentForeingKey  = 'role_id';
        $relatedPrimaryKey = 'value';
        $relatedForeingKey = 'permission_value';

        return $this->belongsToMany(EloquentPermission::class, $pivotTable, $parentForeingKey, $relatedForeingKey, $parentPrimaryKey, $relatedPrimaryKey);
    }
}