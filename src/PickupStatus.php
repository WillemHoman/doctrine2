<?php
declare(strict_types=1);

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static PickupStatus AWAITING_COLLECTION()
 * @method static PickupStatus COLLECTED()
 */
final class PickupStatus extends AbstractEnumeration
{
    const AWAITING_COLLECTION = 'awaitingCollection';
    const COLLECTED = 'collected';
}