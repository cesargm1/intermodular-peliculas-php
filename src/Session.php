<?php

namespace App;

class Session
{
    public function __construct()
    {
        if ($this->getId()) {
            return;
        }
        session_start();
    }

    public function getId(): string
    {
        return session_id();
    }

    public function regenerateId(): bool
    {
        return session_regenerate_id(true);
    }
}
