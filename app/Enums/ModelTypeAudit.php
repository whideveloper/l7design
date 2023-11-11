<?php

namespace App\Enums;

use ReflectionClass;

class ModelTypeAudit
{
    public const SUBJECTS = 'Disciplinas';
    public const STUDENTS = 'Alunos';
    public const COURSES = 'Cursos';

    public static function getLabel($modelType)
    {
        $constants = (new ReflectionClass(self::class))->getConstants();

        return $constants[$modelType] ?? $modelType;
    }
}
