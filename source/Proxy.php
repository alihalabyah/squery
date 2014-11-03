<?php

namespace Formativ\Query;

abstract class Proxy
{
    /**
     * @var mixed
     */
    protected $instance;

    /**
     * @return mixed
     */
    abstract protected function createNewInstance();

    /**
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, array $parameters)
    {
        if ($this->instance === null) {
            $this->instance = $this->createNewInstance();
        }

        if (method_exists($this->instance, $method)) {
            return call_user_func_array([$this->instance, $method], $parameters);
        }
    }

    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }
}
