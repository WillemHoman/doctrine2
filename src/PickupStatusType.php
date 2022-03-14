<?php

declare(strict_types=1);

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

class PickupStatusType extends Type
{

    const PICKUP_STATUS_TYPE = 'pickup_status';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value instanceof PickupStatus) {
            throw new InvalidArgumentException('convertToDatabaseValue');
        }

        switch ($value) {
            case PickupStatus::AWAITING_COLLECTION():
                $intValue = 1;
                break;
            case PickupStatus::COLLECTED():
                $intValue = 2;
                break;
        }
        return $intValue;
    }
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "int";
    }

    /**
     * @param $value
     * @param AbstractPlatform $platform
     * @return bool|DateTime|false|mixed
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): PickupStatus
    {
        if (!$value instanceof PickupStatus) {
            throw new InvalidArgumentException('convertToPHPValue');
        }

        switch ($value) {
            case 1:
                $phpValue = PickupStatus::AWAITING_COLLECTION();
                break;
            case 2:
                $phpValue = PickupStatus::COLLECTED();
                break;
            default:
                throw ConversionException::conversionFailedFormat(
                    $value,
                    $this->getName(),
                    $platform->getDateTimeFormatString()
                );
        }

        return $phpValue;
    }


    public function getName()
    {
        return self::PICKUP_STATUS_TYPE; // modify to match your constant name
    }
}