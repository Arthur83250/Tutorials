<?php

class Creneau {
    
    public $start;
    public $end;

    public function __construct(int $start, int $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function toHTML (): string
    {
        return "<strong>{$this->start}h</strong> à <strong>{$this->end}h</strong>";
    }

    public function inclusHeure(int $hour): bool
    {
        return $hour >= $this->start && $hour <= $this->end;
    }

    public function intersect (Creneau $creneau): bool
    {
        return $this->inclusHeure($creneau->start) || $this->inclusHeure($creneau->end) || ($creneau->start < $this->start && $creneau->end > $this->end);
    }
}