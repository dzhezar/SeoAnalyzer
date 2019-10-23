<?php


namespace App\DTO;


class FormDTO
{
    private $url;
    private $choices;

    /**
     * FormDTO constructor.
     * @param $url
     * @param $choices
     */
    public function __construct(string $url = null, array $choices = null)
    {
        $this->url = $url;
        $this->choices = $choices;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getChoices(): ?array
    {
        return $this->choices;
    }

    /**
     * @param array $choices
     */
    public function setChoices(array $choices): void
    {
        $this->choices = $choices;
    }
}
