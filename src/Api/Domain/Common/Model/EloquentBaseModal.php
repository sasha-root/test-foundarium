<?php declare(strict_types=1);

namespace Api\Domain\Common\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Base modal class
 *
 * @method static Builder first()
 * @method static Builder query()
 * @method static Builder truncate()
 */
abstract class EloquentBaseModal extends Model
{

}
