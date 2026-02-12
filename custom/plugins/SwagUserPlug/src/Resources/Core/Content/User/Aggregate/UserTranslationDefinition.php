<?php declare(strict_types=1);

namespace Swag\BasicExample\Core\Content\Example\Aggregate\ExampleTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Swag\UserPlug\Core\Content\User\UserDefinition;

class UserTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'swag_user_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getParentDefinitionClass(): string
    {
        return UserDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new StringField('name', 'name'))->addFlags(new Required()),
            (new StringField('city', 'city'))->addFlags(new Required()),
        ]);
    }
}