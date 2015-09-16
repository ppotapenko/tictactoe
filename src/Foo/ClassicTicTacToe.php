<?php

namespace Foo;

class ClassicTicTacToe implements TicTacToeInterface
{
    private $game_field, $winner, $is_ended, $step;

    public function __construct()
    {
        $this->game_field = array(
            array(0, 0, 0),
            array(0, 0, 0),
            array(0, 0, 0)
        );
        $this->winner = false;
        $this->is_ended = false;
        $this->step = 0;
    }

    /**
     * $x,$y - 0-2
     * @param $x integer
     * @param $y integer
     * @throws FieldTakenException
     */
    public function putX($x, $y)
    {
        if(empty($this->game_field[$x][$y]))
        {
            if(!$this->is_ended)
            {
                $this->game_field[$x][$y] = 'X';
                $this->step += 1;
                if($this->is_won('X', $x, $y))
                {
                    $this->winner = 'X';
                    $this->is_ended = true;
                }
                elseif($this->step == 9)
                {
                    $this->is_ended = true;
                }
            }
        }
        else
        {
            throw new FieldTakenException("Field already occupied");
        }
    }

    /**
     * $x,$y - 0-2
     * @param $x integer
     * @param $y integer
     * @throws FieldTakenException
     */
    public function putO($x, $y)
    {
        if(empty($this->game_field[$x][$y]))
        {
            if(!$this->is_ended)
            {
                $this->game_field[$x][$y] = 'O';
                $this->step += 1;
                if($this->is_won('O', $x, $y))
                {
                    $this->winner = 'O';
                    $this->is_ended = true;
                }
                elseif($this->step == 9)
                {
                    $this->is_ended = true;
                }
            }
        }
        else
        {
            throw new FieldTakenException("Field already occupied");
        }
    }

    /**
     * @return boolean
     */
    public function isEnded()
    {
        return $this->is_ended;
    }

    /**
     * @return boolean
     */
    public function isTied()
    {
        return !$this->winner;
    }

    /**
     * ('X' or 'Y')//TODO: Maybe 'X' or 'O'?
     * @return string
     */
    public function getWinner()
    {
        return $this->winner;
    }

//TODO: Optimize for a minimum of operations
    /**
     * @param $mark
     * @param $x
     * @param $y
     * @return bool
     */
    private function is_won($mark, $x, $y)
    {
        $f = $this->game_field;
        if($this->step >= 5)
        {
            return ($f[$x][0] === $mark && $f[$x][1] === $mark && $f[$x][2] === $mark) ||
                   ($f[0][$y] === $mark && $f[1][$y] === $mark && $f[2][$y] === $mark) ||
                   ($f[0][0] === $mark && $f[1][1] === $mark && $f[2][2] === $mark) ||
                   ($f[2][0] === $mark && $f[1][1] === $mark && $f[0][2] === $mark);
        }
        return false;
    }
}