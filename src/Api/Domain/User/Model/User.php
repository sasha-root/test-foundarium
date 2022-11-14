<?php declare(strict_types=1);

namespace Api\Domain\User\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * User model
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property-write string $password
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function createUser(string $name, string $email, string $password): self
    {
        $model = new self();
        $model->setName($name);
        $model->setEmail($email);
        $model->setPassword($password);

        return $model;
    }

    public function updateUser(string $name, string $email): self
    {
        $this->setName($name);
        $this->setEmail($email);

        return $this;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPassword(string $password)
    {
        $this->password = bcrypt($password);
    }
}
