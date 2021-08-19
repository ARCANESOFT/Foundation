<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Session;

use Arcanesoft\Foundation\Authorization\Repositories\SessionsRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\QueryException;
use Illuminate\Session\ExistenceAwareInterface;
use Illuminate\Support\{Arr, InteractsWithTime};
use SessionHandlerInterface;

/**
 * Class     DatabaseSessionHandler
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSessionHandler implements ExistenceAwareInterface, SessionHandlerInterface
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use InteractsWithTime;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * The sessions' repository.
     *
     * @var  \Arcanesoft\Foundation\Authorization\Repositories\SessionsRepository
     */
    protected $repo;

    /**
     * The existence state of the session.
     *
     * @var bool
     */
    protected $exists;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new database session handler instance.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\SessionsRepository  $repo
     * @param  \Illuminate\Contracts\Container\Container|null               $container
     */
    public function __construct(SessionsRepository $repo, Container $container = null)
    {
        $this->container = $container;
        $this->repo = $repo;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritdoc}
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function read($sessionId)
    {
        $session = $this->findSession($sessionId);

        if (is_null($session))
            return '';

        if ($session->hasExpired()) {
            $this->exists = true;

            return '';
        }

        if ($session->payload) {
            $this->exists = true;

            return base64_decode($session->payload);
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function write($sessionId, $data)
    {
        $payload = $this->getDefaultPayload($data);

        if ( ! $this->exists) {
            $this->read($sessionId);
        }

        $this->exists
            ? $this->performUpdate($sessionId, $payload)
            : $this->performInsert($sessionId, $payload);

        return $this->exists = true;
    }

    /**
     * Perform an insert operation on the session ID.
     *
     * @param  string  $sessionId
     * @param  array   $attributes
     *
     * @return bool|null
     */
    protected function performInsert($sessionId, $attributes)
    {
        Arr::set($attributes, 'id', $sessionId);

        try {
            return $this->repo->newModelInstance($attributes)->save();
        }
        catch (QueryException $e) {
            $this->performUpdate($sessionId, $attributes);
        }

        return null;
    }

    /**
     * Perform an update operation on the session ID.
     *
     * @param  string  $sessionId
     * @param  array   $payload
     *
     * @return int
     */
    protected function performUpdate($sessionId, $payload)
    {
        $session = $this->repo->find($sessionId);

        if ( ! is_null($session) && $session->update($payload)) {
            return 1;
        }

        return 0;
    }

    /**
     * Add the user information to the session payload.
     *
     * @param  array  $payload
     *
     * @return $this
     */
    protected function addUserInformation(&$payload)
    {
        if ($this->container->bound(Guard::class)) {
            $payload = array_merge($payload, [
                'user_id' => $this->userId(),
                'guard'   => $this->userGuard(),
            ]);
        }

        return $this;
    }

    /**
     * Get the default payload for the session.
     *
     * @param  string  $data
     *
     * @return array
     */
    protected function getDefaultPayload($data): array
    {
        $payload = [
            'payload'       => base64_encode($data),
            'last_activity' => $this->currentTime(),
        ];

        if ( ! $this->container) {
            return $payload;
        }

        return tap($payload, function (&$payload) {
            $this->addUserInformation($payload);
            $this->addRequestInformation($payload);
        });
    }

    /**
     * Get the currently authenticated user's ID.
     *
     * @return mixed
     */
    protected function userId()
    {
        return $this->container->make(Guard::class)->id();
    }

    /**
     * Add the request information to the session payload.
     *
     * @param  array  $payload
     * @return $this
     */
    protected function addRequestInformation(&$payload)
    {
        if ($this->container->bound('request')) {
            $payload = array_merge($payload, [
                'ip_address' => $this->ipAddress(),
                'user_agent' => $this->userAgent(),
            ]);
        }

        return $this;
    }

    /**
     * Get the IP address for the current request.
     *
     * @return string
     */
    protected function ipAddress()
    {
        return $this->container->make('request')->ip();
    }

    /**
     * Get the user agent for the current request.
     *
     * @return string
     */
    protected function userAgent()
    {
        return substr((string) $this->container->make('request')->header('User-Agent'), 0, 500);
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($sessionId)
    {
        $this->repo->where('id', $sessionId)->delete();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function gc($lifetime)
    {
        $this->repo
            ->where('last_activity', '<=', $this->currentTime() - $lifetime)
            ->delete();
    }

    /**
     * Find a session.
     *
     * @param  string  $sessionId
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\Session|mixed|null
     */
    protected function findSession($sessionId)
    {
        return $this->repo->find($sessionId);
    }

    /**
     * Set the existence state for the session.
     *
     * @param  bool  $value
     * @return $this
     */
    public function setExists($value)
    {
        $this->exists = $value;

        return $this;
    }

    /**
     * Get the user's guard name.
     *
     * @return string|null
     */
    protected function userGuard(): ?string
    {
        $guard = $this->container->make(Guard::class);

        return explode('_', $guard->getName())[1] ?? null;
    }
}
