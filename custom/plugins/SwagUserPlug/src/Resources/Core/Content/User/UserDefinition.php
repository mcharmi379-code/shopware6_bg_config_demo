<?php declare(strict_types=1);

namespace SwagUserPlug\Core\Content\User;

use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\System\Country\Aggregate\CountryState\CountryStateDefinition;
use Shopware\Core\System\Country\CountryDefinition;
use SwagUserPlug\Core\Content\User\Aggregate\UserTranslation\UserTranslationDefinition;
use SwagUserPlug\Core\Content\User\UserEntity;
use SwagUserPlug\Core\Content\User\UserCollection;


class UserDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'swag_user';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return UserEntity::class;
    }

    public function getCollectionClass(): string
    {
        return UserCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new TranslatedField('name'))->addFlags(new Required()),
            (new TranslatedField('city'))->addFlags(new Required()),
          (new BoolField('is_active', 'isActive'))->addFlags(new Required()),
            (new FkField('country_id', 'countryId', CountryDefinition::class)),
            (new FkField('country_state_id', 'countryStateId', CountryStateDefinition::class)),
            (new FkField('product_id', 'productId', ProductDefinition::class)),
            (new FkField('media_id', 'mediaId', MediaDefinition::class)),


            new ManyToOneAssociationField('country', 'country_id', 'id', CountryDefinition::class, false),
            new ManyToOneAssociationField('countryState', 'country_state_id', 'id', CountryStateDefinition::class, false),
            new ManyToOneAssociationField('product', 'product_id', 'id', ProductDefinition::class, false),
            new ManyToOneAssociationField('media', 'media_id', 'id', MediaDefinition::class, false),
            (new TranslationsAssociationField(UserTranslationDefinition::class,'swag_user_id'))

        ]);
    }
}