<?php

namespace App\Models;

use App\Models\Sav;
use App\Models\Banner;
use App\Models\Protocol;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditActivity extends Model
{
    use HasFactory;

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
    public const CATEGORIA_ESPECIALIDADE = 'Caregoria Especialidade';
    public const SESSAO_ESPECIALIDADE = 'Sessão Especialidade';
    public const PROFESSIONAL_ESPECIALIDADE = 'Profissionais especialistas';
    public const TUTORIAL = 'Tutorial';
    public const PARCEIROS = 'Parceiros';
    public const TREINAMENTO_PLATAFORMA = 'Treinamento para uso da plataforma';
    public const ARQUIVOS_TREINAMENTO = 'Arquivos de treinamentos';
    public const PROTOCOLOS = 'Protocolos';
    public const MATERIAL = 'Material de apoio';
    public const MATERIAL_DOCUMENTO = 'Documento do Material de apoio';
    public const AGENDAMENTO = 'Agendamento';
    public const MURAL_DE_APOIO = 'Mural de apoio';
    public const SAV = 'Sav';
    public const LEAD = 'Leads';
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
            case User::class:
                return self::USERS;
            case EspecialidadeCategory::class:
                return self::CATEGORIA_ESPECIALIDADE;
            case EspecialidadeSession::class:
                return self::SESSAO_ESPECIALIDADE;
            case EspecialidadeProfessional::class:
                return self::PROFESSIONAL_ESPECIALIDADE;
            case Tutorial::class:
                return self::TUTORIAL;
            case TrainingForUse::class:
                return self::TREINAMENTO_PLATAFORMA;
            case TrainingForUse::class:
                return self::ARQUIVOS_TREINAMENTO;
            case Protocol::class:
                return self::PROTOCOLOS;
            case Material::class:
                return self::MATERIAL;
            case MaterialDocument::class:
                return self::MATERIAL_DOCUMENTO;
            case Agendamento::class:
                return self::AGENDAMENTO;
            case MuralDeApoio::class:
                return self::MURAL_DE_APOIO;
            case Role::class:
                return self::ROLES;
            case Sav::class:
                return self::SAV;
            case Lead::class:
                return self::LEAD;
            default:
                return 'Desconhecido';
        }
    }
}
