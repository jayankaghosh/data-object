<?php


namespace DataObject;


interface DataObjectInterface
{
    /**
     * @param string|null $key
     * @param mixed|null $default
     * @return array|mixed|null
     */
    public function getData(?string $key = null, $default = null);

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setData(string $key, $value): self;

    /**
     * @param string|null $key
     * @return $this
     */
    public function unsData(?string $key = null): self;

    /**
     * @param array $data
     * @return $this
     */
    public function addData(array $data): self;
}
