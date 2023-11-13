<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditActivity extends Model
{
    use HasFactory;

    public const SUBJECTS = 'Disciplinas';
    public const USERS = 'Professores';
    public const COURSES = 'Cursos';
    public const STUDENTS = 'Alunos';
    public const FILES = 'Atividades';
    public const ROLES = 'Grupos';

    public static function getModelName($subjectType)
    {
        switch ($subjectType) {
            case Subject::class:
                return self::SUBJECTS;
            case User::class:
                return self::USERS;
            case Course::class:
                return self::COURSES;
            case Student::class:
                return self::STUDENTS;
            case File::class:
                return self::FILES;
            case Role::class:
                return self::ROLES;
            default:
                return 'Desconhecido';
        }
    }
}
