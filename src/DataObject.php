<?php


namespace DataObject;


class DataObject
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * DataObject constructor.
     * @param array $data
     */
    public function __construct(
        array $data = []
    )
    {
        $this->data = $data;
    }

    /**
     * @param string|null $key
     * @param mixed|null $default
     * @return array|mixed|null
     */
    public function getData(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $this->data;
        }
        return $this->data[$key] ?? $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setData(string $key, $value): self
    {
        if ($key) {
            $this->data[$key] = $value;
        }
        return $this;
    }

    public function unsData(?string $key = null): self
    {
        if ($key === null) {
            $this->data = [];
        } else if (isset($this->data[$key])) {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function addData(array $data): self
    {
        foreach ($data as $key => $value) {
            $this->setData($key, $value);
        }
        return $this;
    }

    public function __call($name, $arguments)
    {
        $key = $this->camelToSnakeCase(substr($name, 3));
        if ($this->startsWith($name, 'get')) {
            return $this->getData($key);
        } else if ($this->startsWith($name, 'set')) {
            return $this->setData($key, $arguments[0] ?? null);
        } else if ($this->startsWith($name, 'uns')) {
            return $this->unsData($key);
        } else {
            throw new \RuntimeException('DataObjects support only "getX", "setX", and "unsX" methods');
        }
    }

    protected function camelToSnakeCase(string $word): string
    {
        return strtolower(
            str_replace(
                ' ',
                '_',
                trim(
                    preg_replace(
                        '/([A-Z])/',
                        ' $1',
                        $word
                    )
                )
            )
        );
    }

    protected function snakeToCamelCase(string $word): string
    {
        return str_replace(
            '_',
            '',
            lcfirst(ucwords(strtolower($word), '_'))
        );
    }

    protected function startsWith(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) === 0;
    }
}
