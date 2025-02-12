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
}
