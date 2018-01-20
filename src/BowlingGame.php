<?php

/**
 * Class BowlingGame
 */
class BowlingGame
{

    /**
     * @var array
     */
    protected $rolls = [];
    /**
     * @var int
     */
    protected $score = 0;

    /**
     * @param $pins
     */
    public function roll($pins)
    {
        $this->rolls[] = $pins;

    }

    /**
     * @return int
     */
    public function score()
    {
        $score = 0;
        $roll = 0;
        for($frame=1; $frame<=10; $frame++)
        {
            if($this->isStrike($roll))
            {//STRIKE!!!
                $score += 10 + $this->strikeBonus($roll);
                $roll++;
            }

            // $this->isSpare($roll) ? 10 + $this->spareBonus : $this->defaultFrameScore($roll);
            else if($this->isSpare($roll))
            {
                $score += 10 + $this->spareBonus($roll);
                $roll += 2;
            }
            else
            {
                $score += $this->getDefaultFrameScore($roll);
                $roll += 2;
            }

        }
        return $score;
    }

    /**
     * @param $roll
     * @return bool
     */
   public function isSpare($roll)
    {
        return $this->getDefaultFrameScore($roll) == 10;
   }

    /**
     * @param $roll
     * @return mixed
     */
    public function getDefaultFrameScore($roll)
    {
        return $this->rolls[$roll] + $this->rolls[$roll + 1];
    }

    /**
     * @param $roll
     * @return bool
     */
    public function isStrike($roll)
    {
        return $this->rolls[$roll] == 10;
    }

    /**
     * @param $roll
     * @return mixed
     */
    private function strikeBonus($roll)
    {
        return $this->rolls[$roll+1] + $this->rolls[$roll+2];
    }

    /**
     * @param $roll
     * @return mixed
     */
    private function spareBonus($roll)
    {
        return $this->rolls[$roll + 2];
    }
}
