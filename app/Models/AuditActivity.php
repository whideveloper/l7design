<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditActivity extends Model
{
    use HasFactory;

    public const SUBJECTS = 'Disciplinas';
    public const USERS = 'Usuários';
    public const BANNER = 'Banner';
    public const TELENORDESTE = 'Telenordeste';
    public const OBJETIVO = 'Objetivo';
    public const TELEINTERCONSULTA = 'Teleinterconsulta';
    public const LOCALIZACAO = 'Localização';
    public const COMO_FUNCIONA = 'Como Funciona';
    public const PASSO_A_PASSO = 'Passo a passo';
    public const HOSPITAL = 'Hospital';
    public const PROADI = 'Proadi';
    public const DEPOIMENTO = 'Depoimento';
    public const PARCEIROS = 'Parceiros';

    public const COURSES = 'Cursos';
    public const STUDENTS = 'Alunos';
    public const FILES = 'Atividades';
    public const ROLES = 'Grupos';

    public static function getModelName($subjectType)
    {
        switch ($subjectType) {
            case Banner::class:
                return self::BANNER;
            case Telenordeste::class:
                return self::TELENORDESTE;
            case Objective::class:
                return self::OBJETIVO;
            case Teleinterconsulta::class:
                return self::TELEINTERCONSULTA;
            case Location::class:
                return self::LOCALIZACAO;
            case HowItWork::class:
                return self::COMO_FUNCIONA;
            case Hospital::class:
                return self::HOSPITAL;
            case StepToStep::class:
                return self::PASSO_A_PASSO;
            case Proadi::class:
                return self::PROADI;
            case Depoiment::class:
                return self::DEPOIMENTO;
            case Partner::class:
                return self::PARCEIROS;


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
