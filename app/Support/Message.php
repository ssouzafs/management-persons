<?php

namespace App\Support;

/**
 * Classe utilizada como interface de notificação com usuário.
 */
class Message
{
    private string $message;
    private string $type;
    private ?string $icon;
    private bool $toUpper;

    public function __construct($toUpper = false)
    {
        $this->toUpper = $toUpper;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function success(string $message, $icon = 'icon-check-square-o'): Message
    {
        $this->icon = $icon;
        $this->type = "success";
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function alert(string $message, $icon = 'icon-circle'): Message
    {
        $this->icon = $icon;
        $this->type = "warning";
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function info(string $message, $icon = 'icon-check'): Message
    {
        $this->icon = $icon;
        $this->type = "info";
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function error(string $message, $icon = 'icon-asterisk'): Message
    {
        $this->icon = $icon;
        $this->type = "error";
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function criticalError(string $message, $icon = 'icon-asterisk'): Message
    {
        $this->icon = $icon;
        $this->type = "error-server";
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    function flashRender(): ?string
    {
        if ($this->type && $this->message) {
            $_SESSION["flash"] = [
                "type" => $this->type,
                "message" => $this->message
            ];
            return null;
        }

        if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) {

            unset($_SESSION["flash"]);
            return "<div class=\"trigger {$flash["type"]}\">{$flash["message"]}</div>";
        }

        return null;
    }


    /**
     * @return string
     */
    public function render(): string
    {
        $message = ($this->toUpper == true) ? mb_strtoupper($this->message) : $this->message;
        return "<div class='message {$this->type}'>{$message}</div>";
    }

    /**
     * @return string
     */
    public function renderNotify(): string
    {
        $message = ($this->toUpper === true) ? mb_strtoupper($this->message) : $this->message;
        return "<div class=\"trigger {$this->type} {$this->icon}\">{$message}</div>";
    }
}
